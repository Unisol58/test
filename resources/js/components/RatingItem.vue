<template>
<div class="rating">
    <ul class="list">
        <li :key="star" v-for="star in maxRating" :class="{ 'active': star <= stars }" @click="rate(star)" class="star">

            <i scale="0.8" v-if="star <= stars" class="fas fa-star" />
            <i scale="0.8" v-else class="far fa-star muted" />
        </li>
    </ul>
    <span class="counter" v-if="hasCounter">Keskmine hinne: {{ this.recipeData.average_rating }}</span>
</div>
</template>

<script>
export default {
    props: {

        maxRating: {
            type: Number,
            default: 5
        },
        hasCounter: {
            type: Boolean,
            default: true
        },
        recipe: {},
        user: {},
        recipeData: 0,
    },
    data() {
        return {
            stars: this.rating
        }
    },
    mounted() {
        this.hasRated()
    },
    methods: {
        rate: function(star) {
            if (
                typeof star === 'number' &&
                star <= this.maxRating &&
                star >= 0
            )
                this.stars = this.stars === star ? star - 1 : star

            this.storeRating();
        },
        storeRating: function() {
            var _this = this;
            axios.post('/api/ratings', {
                    rating: this.stars,
                    recipe_id: this.recipe.id
                })
                .then(function(response) {

                })
                .catch(function(error) {
                    console.log(error)
                });
        },

        hasRated: function() {
            var _this = this;
            axios.get(`/api/user/${this.user.id}/rating/${this.recipe.id}`)
                .then(function(response) {
                    _this.stars = response.data[0].rating
                })
                .catch(function(error) {
                    console.log(error)
                });
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
