<template>
<div class="rating">
    <ul class="list">
        <li :key="star" v-for="star in maxRating" :class="{ 'active': star <= stars }" @click="rate(star)" class="star">

            <i scale="0.8" v-if="star <= stars" class="fas fa-star" />
            <i scale="0.8" v-else class="far fa-star muted" />
        </li>
    </ul>
    <span class="counter" v-if="hasCounter">{{ stars }} of {{ maxRating }}</span>
</div>
</template>

<script>
export default {
    props: {
        rating: {
            type: Number,
            required: true
        },
        maxRating: {
            type: Number,
            default: 5
        },
        hasCounter: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            stars: this.rating
        }
    },
    methods: {
        rate(star) {
            if (
                typeof star === 'number' &&
                star <= this.maxRating &&
                star >= 0
            )
                this.stars = this.stars === star ? star - 1 : star
        }
    }
}
</script>

<style scoped lang="scss">
$active-color: #f3d23e;

.rating {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    font-size: 22px;
    color: #a7a8a8;
}
.counter {
    font-size: 16px;
    position: relative;
    top: -1em;
}
.list {
    margin: 0 0 5px;
    padding: 0;
    list-style-type: none;
    &:hover {
        .star {
            color: $active-color;
        }
    }
}
.star {
    display: inline-block;
    cursor: pointer;
    &:hover {
        &~.star {
            &:not(.active) {
                color: inherit;
            }
        }
    }
}
.active {
    color: $active-color;
}
</style>
