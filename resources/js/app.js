import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import ChatMessages from './components/ChatMassages.vue';
import ChatForm from './components/ChatForm.vue';


const app = createApp({}) // here it´s the component

app.component('ChatMessages', ChatMessages)
app.component('ChatForm', ChatForm)

app.mount('#app');