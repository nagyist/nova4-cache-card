import Card from './components/Card.vue';
import GetCacheKeyModal from './components/GetCacheKeyModal.vue';
import ForgetCacheKeyModal from './components/ForgetCacheKeyModal.vue';
import ConfirmFlushCacheModal from './components/ConfirmFlushCacheModal.vue';
import ViewCacheKeyModal from "./components/ViewCacheKeyModal.vue";

Nova.booting((app, store) => {
  // Nova.inertia("CacheCard4", Card);
  app.component('cache-card', require("./components/Card.vue").default);
  app.component('get-cache-key-modal', require("./components/GetCacheKeyModal.vue").default);
  app.component('forget-cache-key-modal', require("./components/ForgetCacheKeyModal.vue").default);
  app.component('confirm-flush-cache-modal', require("./components/ConfirmFlushCacheModal.vue").default);
  app.component('view-cache-key-modal', require("./components/ViewCacheKeyModal.vue").default);
});

