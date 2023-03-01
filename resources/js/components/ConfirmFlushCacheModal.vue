<template>
    <Modal @modal-close="handleClose">
        <div
            class="bg-white rounded-lg shadow-lg overflow-hidden"
            style="width: 460px"
            role="dialog"
            maxWidth="screen-md"
        >
            <div class="p-8">
              <ModalHeader :level="2" class="mb-6" v-text="__('Flush Cache')" />
              <ModalContent>
                <p class="text-80">{{__('Are you sure you want to flush the cache?')}}</p>
              </ModalContent>
            </div>
            <div class="bg-30 px-6 py-3 flex">
                <div class="ml-auto">
                    <button dusk="cancel-get-key-button" type="button" data-testid="cancel-button" @click.prevent="handleClose" class="rounded btn text-80 font-normal h-9 px-3 mr-3 p-2 hover:bg-gray-50 btn-link">{{__('Cancel')}}</button>
                    <button dusk="confirm-get-key-button" ref="confirmButton" data-testid="confirm-button" @click.prevent="handleConfirm" class="rounded btn btn-default btn-primary p-2 bg-primary-500 text-white">{{__('Flush')}}</button>
                </div>
            </div>
        </div>
    </Modal>
</template>

<script>
export default {
  name: "ConfirmFlushCacheModal",

    /**
     * Mount the component.
     */
    mounted() {
      if(this.$refs?.confirmButton) {
        this.$refs.confirmButton.focus();
      }
    },

    methods: {
        handleClose() {
            this.$emit('close')
        },

        handleConfirm() {
            this.$emit('confirm');
        },
    },
}
</script>
<style scoped>
</style>
