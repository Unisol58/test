<template>
<div>

    <transition name="modal" appear>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="sk-folding-cube" v-if="loading">
                        <div class="sk-cube1 sk-cube"></div>
                        <div class="sk-cube2 sk-cube"></div>
                        <div class="sk-cube4 sk-cube"></div>
                        <div class="sk-cube3 sk-cube"></div>
                    </div>


                    <div class="container">
                        <div class="row justify-content-end">
                            <button type="button" @click="$emit('close')" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="recipe-info">
                                    <span class="h3 d-block">{{ this.recipe.original_name }}</span>
                                    <price-range-item style="float:left;" v-bind:grade='this.price' />
                                    <span style="padding:0px 5px;">&#183;</span>
                                    <span>{{ this.recipe.energy }} kcal</span>
                                    <span style="padding:0px 5px;">&#183;</span>
                                    <span>
                                        <i class="far fa-clock"></i>
                                        {{ this.recipe.preparation_time }} min
                                    </span>
                                </div>

                                <div class="">
                                    <rating-item v-bind:rating="this.rating" />
                                </div>
                            </div>
                            <div class="col-sm">

                                <img :src="this.recipe.image" class='main-image' alt="">
                            </div>
                        </div>



                        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="toiduained-tab" data-toggle="tab" href="#toiduained" role="tab" aria-controls="toiduained" aria-selected="true">Toiduained</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="valmistamine-tab" data-toggle="tab" href="#valmistamine" role="tab" aria-controls="valmistamine" aria-selected="false">Valmistamine</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Kommentaarid ({{ this.comments.length }})</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="toiduained" role="tabpanel" aria-labelledby="toiduained-tab">
                                <ul class="list-group list-group-flush" v-for="ingredients in this.recipe.ingredients">
                                    <li class="list-group-item">{{ ingredients.amount }}g ({{ ingredients.custom_amount }} {{ ingredients.custom_unit_name }}) {{ ingredients.original_name }}
                                        <img v-if="ingredients.logo_image" :src="ingredients.logo_image" class="ingredient-logo">
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="valmistamine" role="tabpanel" aria-labelledby="valmistamine-tab">
                                <div class="list-group" v-html="this.recipe.instructions">

                                </div>
                            </div>
                            <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                                <comments-item v-bind:recipe_id="this.recipe.id" v-bind:comments="this.comments" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</div>
</template>

<script>
export default {
    created() {
        this.loading = true;
        this.getDetailedInfo(this.slug)
    },
    mounted() {
        console.log(this)
    },

    props: {
        price: {
            type: Number,
            required: true
        },
        id: {
            type: Number,
            required: true
        },
        slug: {
            type: String,
            required: true
        },
        rating: {
            type: Number,
            required: false,
            default: 0
        },
        comments: {
            type: Array,
            required: false,
        },
    },
    data() {
        return {
            showModal: false,
            recipe: false,
            loading: false,
        }
    },

    methods: {
        getDetailedInfo: function() {
            axios.get(`https://api.fitlap.ee/v2/recipe/public?slug=${this.slug}`)
                .then((response) => {
                    this.reset()
                    this.recipe = response.data.data
                    console.log(this.recipe)
                })
                .catch()
                .finally(() => {
                    this.reset()
                });
        },

        reset: function() {
            this.loading = false;
        }
    }
}
</script>

<style scoped lang="scss">
#toiduained li {
    display: block;
    width: 100%;
}
// .main-image {
//     position: relative;
//     left: -8em;
//     top: 0;
// }
.ingredient-logo {
    width: 20px;
    margin-left: 5px;
    margin-right: 5px;
}
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
    z-index: 1;
}

.modal-container {
    width: 800px;
    margin: 0 auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
    opacity: 0;
}

.modal-leave-active {
    opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}

.sk-folding-cube {
    margin: 20px auto;
    width: 40px;
    height: 40px;
    position: relative;
    -webkit-transform: rotateZ(45deg);
    transform: rotateZ(45deg);
}

.sk-folding-cube .sk-cube {
    float: left;
    width: 50%;
    height: 50%;
    position: relative;
    -webkit-transform: scale(1.1);
    -ms-transform: scale(1.1);
    transform: scale(1.1);
}
.sk-folding-cube .sk-cube:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #333;
    -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
    animation: sk-foldCubeAngle 2.4s infinite linear both;
    -webkit-transform-origin: 100% 100%;
    -ms-transform-origin: 100% 100%;
    transform-origin: 100% 100%;
}
.sk-folding-cube .sk-cube2 {
    -webkit-transform: scale(1.1) rotateZ(90deg);
    transform: scale(1.1) rotateZ(90deg);
}
.sk-folding-cube .sk-cube3 {
    -webkit-transform: scale(1.1) rotateZ(180deg);
    transform: scale(1.1) rotateZ(180deg);
}
.sk-folding-cube .sk-cube4 {
    -webkit-transform: scale(1.1) rotateZ(270deg);
    transform: scale(1.1) rotateZ(270deg);
}
.sk-folding-cube .sk-cube2:before {
    -webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;
}
.sk-folding-cube .sk-cube3:before {
    -webkit-animation-delay: 0.6s;
    animation-delay: 0.6s;
}
.sk-folding-cube .sk-cube4:before {
    -webkit-animation-delay: 0.9s;
    animation-delay: 0.9s;
}
@-webkit-keyframes sk-foldCubeAngle {
    0%,
    10% {
        -webkit-transform: perspective(140px) rotateX(-180deg);
        transform: perspective(140px) rotateX(-180deg);
        opacity: 0;
    }
    25%,
    75% {
        -webkit-transform: perspective(140px) rotateX(0deg);
        transform: perspective(140px) rotateX(0deg);
        opacity: 1;
    }
    100%,
    90% {
        -webkit-transform: perspective(140px) rotateY(180deg);
        transform: perspective(140px) rotateY(180deg);
        opacity: 0;
    }
}

@keyframes sk-foldCubeAngle {
    0%,
    10% {
        -webkit-transform: perspective(140px) rotateX(-180deg);
        transform: perspective(140px) rotateX(-180deg);
        opacity: 0;
    }
    25%,
    75% {
        -webkit-transform: perspective(140px) rotateX(0deg);
        transform: perspective(140px) rotateX(0deg);
        opacity: 1;
    }
    100%,
    90% {
        -webkit-transform: perspective(140px) rotateY(180deg);
        transform: perspective(140px) rotateY(180deg);
        opacity: 0;
    }
}

.close {
    display: relative;
    right: 0;
    top: 0;
}
</style>
