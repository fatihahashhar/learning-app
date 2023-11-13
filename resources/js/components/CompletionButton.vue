<template>
    <button :class="buttonClass" @click="toggleCompletion">{{ buttonText }}</button>
</template>

<script>
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

                    // Display success message using SweetAlert Toast
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'Topic completion status updated successfully',
                    });

                    this.localIsCompleted = response.data.isCompleted;
                    console.log('is_completed value', this.localIsCompleted);
                })
                .catch(error => {
                    console.error(error);

                    // Display error message using SweetAlert Toast
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'Unable to update topic completion status',
                    });
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
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    border: 2px solid #ffffff;
    border-radius: 4px;
    transition: all 0.3s ease-in-out;
}

.button_green:hover {
    background-color: #1e6b0d;
    border-color: #1e6b0d;
}

.button_red {
    display: inline-block;
    padding: 8px 10px;
    margin-right: 2px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    border: 2px solid #ffffff;
    border-radius: 4px;
    transition: all 0.3s ease-in-out;
}

.button_red:hover {
    background-color: #77150c;
    border-color: #77150c;
}</style>