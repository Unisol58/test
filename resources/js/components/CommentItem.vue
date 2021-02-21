<template>
<div class="comment mt-2">
    <div class="card w-100">
        <div class="card-body">
            <span class="card-title h5 name">{{ comment.name }}</span> <span class="h6 ml-2 text-muted"><small>{{ comment.created_at | formatDateFromNow }}</small></span>
            <p class="card-text mt-1">{{ comment.comment }}</p>
        </div>
    </div>

    <!-- <div class="text">
        <a class="username" href="#">
            {{ comment.name }}
        </a>
        <span>{{ comment.comment }}</span>
    </div> -->
</div>
</template>

<script>
export default {
    props: {
        comment: {
            type: Object,
            required: true
        },
    },
}
</script>

<style scoped lang="scss">
.name {
    color: #1E90FF;
}
</style>
