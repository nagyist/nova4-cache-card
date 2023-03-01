<template>
    <card class="flex items-center justify-center">
        <div class="flex-1 ml-1 pl-8 pr-3">
            <h1 class="text-3xl text-80 font-light">
                {{ card.defaultDriver }} Cache
            </h1>
            <div class="mt-3" v-if="cacheSize.length">
                Cache Size: <code>{{ cacheSize }}</code>
            </div>
        </div>
        <div class="flex-2 m-1 pr-8 pl-3 text-right">
            <div class="flex flex-col mr-4 text-center font-bold">
                <button class="rounded btn btn-default bg-primary-500 text-white mt-1 mb-2 p-2"
                        @click="isGetModalOpen = true">
                  Get
                </button>
                <button class="rounded btn btn-default btn-warning my-2 text-white mt-1 mb-1 p-2"
                        prevent="onForget"
                        @click="isForgetModalOpen = true">
                  Forget
                </button>
                <button class="rounded btn btn-default bg-red-500 text-white mt-2 mb-1 p-2"
                        @click="isFlushModalOpen = true">
                  Flush
                </button>
            </div>
        </div>
      <transition name="slide-fade">
        <get-cache-key-modal
            v-if="isGetModalOpen"
            :show="isGetModalOpen"
            @confirm="onGet"
            @close="isGetModalOpen = false">
        </get-cache-key-modal>
        <forget-cache-key-modal
            v-else-if="isForgetModalOpen"
            :show="isForgetModalOpen"
            @confirm="onForget"
            @close="isForgetModalOpen = false">
        </forget-cache-key-modal>
        <confirm-flush-cache-modal
            v-else-if="isFlushModalOpen == true"
            :show="isFlushModalOpen"
            @confirm="onFlush()"
            @close="isFlushModalOpen = false">
        </confirm-flush-cache-modal>
        <view-cache-key-modal
            v-else
            :show="isViewModalOpen"
            :value="cacheValue"
            :cacheKey="cacheKey"
            @confirm="onViewClose()">
        </view-cache-key-modal>
      </transition>
    </card>
</template>

<script>

import GetCacheKeyModal from './GetCacheKeyModal.vue';
import ForgetCacheKeyModal from './ForgetCacheKeyModal.vue';
import ConfirmFlushCacheModal from './ConfirmFlushCacheModal.vue';
import ViewCacheKeyModal from "./ViewCacheKeyModal.vue";

export default {
    name: "cache-card",
    props: ['card'],
    components: {
      GetCacheKeyModal,
      ForgetCacheKeyModal,
      ConfirmFlushCacheModal,
      ViewCacheKeyModal
    },
    data() {
      return {
            isFlushModalOpen: false,
            isForgetModalOpen: false,
            isGetModalOpen: false,
            isViewModalOpen: false,
            cacheKey: '',
            cacheValue: '',
            cacheSize: this.card.cacheSize,
        }
    },
    methods: {
        onFlush() {
            Nova.request()
                .post('/nova-vendor/nagyist/cachecardnova4/flush')
                .then(response => {
                if (!response.data.success) {
                    this.toastFlushCacheFailed();
                } else {
                    this.toastFlushCacheSuccess();
                }
                this.cacheSize = response.data.size;
            });
            this.isFlushModalOpen = false;
        },
        onForget(cacheKey) {
            Nova.request()
                .post('/nova-vendor/nagyist/cachecardnova4/cache', { cacheKey })
                .then(response => {
                if (!response.data.success) {
                    this.toastInvalidCacheKey(response.data.key);
                } else {
                    this.toastForgotCacheKey(response.data.key);
                }
                this.cacheSize = response.data.size;
            });
            this.isForgetModalOpen = false;
        },
        onGet(cacheKey) {
            Nova.request()
                .get('/nova-vendor/nagyist/cachecardnova4/cache?cacheKey=' + cacheKey)
                .then(response => {
                if (!response.data.success) {
                    this.toastInvalidCacheKey(cacheKey) ; //response.data.key);
                } else {
                    this.cacheValue = response.data.value;
                    this.cacheKey = response.data.key;
                    this.isViewModalOpen = true;
                }
                this.cacheSize = response.data.size;
            });
            this.isGetModalOpen = false;
        },
        onViewClose() {
            this.isViewModalOpen = false;
            this.cacheKey = '';
            this.cacheValue = '';
        },
        toastFlushCacheSuccess() {
            Nova.success('Successfully flushed the cache!');
        },
        toastFlushCacheFailed() {
            Nova.error('There was an issue flushing the cache!');
        },
        toastForgotCacheKey(key) {
            Nova.success('Successfully forgot the cache value associated with key: <strong class="ml-2">' +  key + '</strong>');
        },
        toastInvalidCacheKey(key) {
            Nova.info('There is nothing cached for key: <strong class="ml-2">' +  key + '</strong>');
        },
    },
    mounted() {
      //
    },

}
</script>
<style></style>
