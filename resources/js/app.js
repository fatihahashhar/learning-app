import "./bootstrap";
import { createApp } from "vue";

const app = createApp({});

// IMPORT AND GLOBALLY REGISTER THE COMPONENT

// example vue component
// import ExampleComponent from "./components/ExampleComponent.vue";
// app.component("example-component", ExampleComponent);

// Progress bar
import Progressbar from "./components/Progressbar.vue";
app.component("progress-bar", Progressbar);

// Completion button
import CompletionButton from "./components/CompletionButton.vue";
app.component("completion-button", CompletionButton);

// Vue application is created and mounted on the element with the ID "app."
app.mount("#app");


