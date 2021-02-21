<template>
<div class="rating">
    <ul class="list">
        <li :key="price" v-for="price in maxRange" :class="{ 'active': price <= grade }" class="price">
            <i v-if="grade >= price" class="fas fa-euro-sign price-range" />
            <i v-else class="fas fa-euro-sign price-range muted" />
        </li>
    </ul>
</div>
</template>

<script>
export default {
    props: {
        grade: {
            type: Number,
            required: true
        },
        maxRange: {
            type: Number,
            default: 3
        },
    },
    data() {
        return {}
    },
    methods: {

    },
    computed: {

    }

}
</script>

<style scoped lang="scss">
$active-color: #828282;

.list {
    margin: 0 0 5px;
    padding: 0;
    list-style-type: none;
}
.price {
    font-size: 12px;
    display: inline-block;
}
.active {
    color: $active-color;
}
.price-range {
    font-weight: 200;
    &.muted {
        color: lightgray;
    }
}
</style>
