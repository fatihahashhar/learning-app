<template>
    <button :class="buttonClass" @click="toggleCompletion">{{ buttonText }}</button>
</template>

<script>
// import { isSet } from '@vue/shared';
import axios from 'axios';

export default {
    props: {
        isCompleted: Number,
        topicKey: Number,
        userKey: Number,
    },

    data() {
        return {
            topic_id: this.topicKey,
            user_id: this.userKey,
            localIsCompleted: this.isCompleted,
        };
    },
    computed: {
        buttonClass() {
            return this.localIsCompleted ? 
            'button_red button_red:hover' : 
            'button_green button_green:hover';
        },
        buttonText() {
            return this.localIsCompleted ? 'Mark as Incomplete' : 'Mark as Completed';
        },
    },
    mounted() {
    },
    methods: {
        toggleCompletion() {

            const requestData = {
                userKey: this.userKey,
                topicKey: this.topicKey,
            };

            console.log('userKey', this.userKey, 'topicKey', this.topicKey, requestData);

            axios.put(`/api/updateTopicStatus/${this.topicKey}`, requestData)
                .then(response => {
                    console.log(response);
                    this.localIsCompleted = response.data.isCompleted;
                    console.log('is_completed value', this.localIsCompleted);
                })
                .catch(error => {
                    console.error('Error updating topic status:', error);
                });
        },
    },

};
</script>

<style scoped>
.button_green {
    display: inline-block;
    padding: 8px 10px;
    margin-right: 2px;
    font-size: 12px; /* Adjust font size as needed */
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    border: 2px solid #ffffff; /* Border color */
    border-radius: 4px;
    transition: all 0.3s ease-in-out;
}

.button_green:hover {
    background-color: #1e6b0d; /* Light green background on hover */
    border-color: #1e6b0d; /* Darker green border on hover */
}

.button_red {
    display: inline-block;
    padding: 8px 10px;
    margin-right: 2px;
    font-size: 12px; /* Adjust font size as needed */
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    border: 2px solid #ffffff; /* Border color */
    border-radius: 4px;
    transition: all 0.3s ease-in-out;
}

.button_red:hover {
    background-color: #77150c; /* Light green background on hover */
    border-color: #77150c; /* Darker green border on hover */
}
</style>