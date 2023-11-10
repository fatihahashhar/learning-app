<template>
    <div class="progress-bar">
        <div class="progress" :style="{ width: completionRatio + '%' }"></div>
    </div>
</template>

<script>
export default {
    props: {
        completionRatio: {
            type: Number,
            required: true,
        },
    },
};
</script>

<style scoped>
.progress-bar {
    width: 100%;
    height: 20px;
    background-color: #ccc;
    border: 1px solid #5b5a5a;
    position: relative;
}

.progress {
    height: 100%;
    background-color: rgb(90, 130, 153);
    transition: width 0.3s;
}
</style>