import "./bootstrap";
import { createApp } from "vue";

const app = createApp({});

// REGISTER GLOBAL VUE APPLICATION (COMPONENT)

// example vue component
import ExampleComponent from "./components/ExampleComponent.vue";
app.component("example-component", ExampleComponent);

// Progress bar
import Progressbar from "./components/Progressbar.vue";
app.component("progress-bar", Progressbar);

// Completion button
import CompletionButton from "./components/CompletionButton.vue";
app.component("completion-button", CompletionButton);

app.mount("#app");


