<template>
<div class="">
    <div class="flex">
        <div class="btn-group" role="group">
            <button class="btn btn-outline-secondary" @click="sort('original_name')" v-bind:class="[sortBy === 'original_name' ? sortDirection : '']">Nimi</button>
            <button class="btn btn-outline-secondary" @click="sort('price_range')" v-bind:class="[sortBy === 'price_range' ? sortDirection : '']">Hind</button>
            <button class="btn btn-outline-secondary" @click="sort('preparation_time')" v-bind:class="[sortBy === 'preparation_time' ? sortDirection : '']">Aeg</button>
            <button class="btn btn-outline-secondary" @click="sort('comments')" v-bind:class="[sortBy === 'comments' ? sortDirection : '']">Kommentaarid</button>
        </div>
    </div>
    <div class="container flex">


        <section class='recipe-wrapper' :key="recipe.id" v-for="recipe in sortedRecipes" @click="showRecipe(recipe)">
            <img class="recipe-image" :src="recipe.image" alt="description" />
            <div class="recipe-info">
                <span class="recipe-name">{{ recipe.original_name }}</span>
                <aside>
                    <price-range-item style="float:left;" v-bind:grade='recipe.price_range' />
                    <span style="padding:0px 5px;">&#183;</span>
                    <span>
                        <i class="far fa-clock"></i>
                        {{ recipe.preparation_time }} min
                    </span>
                    <span style="padding:0px 5px;">&#183;</span>
                    <span>
                        <i class="far fa-comment"></i>
                        {{ recipe.comments.length }}
                    </span>
                </aside>

            </div>
        </section>

        <!-- Modal for detailed recipe view  -->
        <view-recipe-item v-if="showModal" @close="showModal = false" v-bind:price="this.price" v-bind:slug="this.slug" v-bind:id="this.id" v-bind:comments="this.comments" />
    </div>
</div>
</template>

<script>
// import 'vue-awesome/icons/clock'

export default {
    data: function() {
        return {
            recipes: [],
            showModal: false,
            slug: false,
            id: false,
            price: 0,
            sortBy: false,
            sortDirection: 'asc',
            comments: false,
        }
    },

    mounted() {
        this.loadRecipies();
    },

    methods: {
        loadRecipies: function() {
            axios.get('/api/recipes')
                .then((response) => {
                    this.recipes = response.data
                })
                .catch();
        },

        showRecipe: function(recipe) {
            this.slug = recipe.slug
            this.price = recipe.price_range
            this.id = recipe.id
            this.comments = recipe.comments
            this.showModal = true
        },

        sort: function(s) {
            console.log(this.sortBy)
            if (s === this.sortBy) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
                id
            }
            this.sortBy = s;
        },
    },

    computed: {
        sortedRecipes: function() {
            if (this.sortBy == false) {
                return this.recipes
            }
            return this.recipes.sort((p1, p2) => {
                let modifier = 1;
                if (this.sortDirection === 'desc') modifier = -1;
                if (p1[this.sortBy] < p2[this.sortBy]) return -1 * modifier;
                if (p1[this.sortBy] > p2[this.sortBy]) return 1 * modifier;
                return 0;
            });
        },
    },
}
</script>

<style media="screen">
.asc:after {
    content: "\25B2";
    padding-left: 5px;
}

.desc:after {
    content: "\25BC";
    padding-left: 5px;
}


.flex {
    display: flex;
    /* Make products flex in row direction (default) */
    flex-wrap: wrap;
    /* Make products overflow on new row */
    justify-content: center;
    /* Or space-between or space-around */
}

.flex>section {
    flex: 1 1 0;
    /* Prevent the extra space around content */
    text-align: center;
    /* Align text on center */
    display: flex;
    /* Display as flex */
    flex-direction: column;
    /* Display flex in column */
    /* align-items: center; */
    /* Align items on center */
    max-width: 350px;
    margin-right: auto;
    margin-bottom: 1em;
    cursor: pointer;

    /* Set max-width so the last items will behave in a more traditional way */
}


.flex>section>p {
    flex-grow: 1;

    /* Keep p's same size */
}

.recipe-wrapper {
    padding: 0.5em;
}

.recipe-wrapper:hover {
    background-color: #f2f2f2;
}

.recipe-info {
    text-align: left;
    align-items: left;
    justify-content: left;
    text-size: 12;
    color: #828282;
    padding: 15px 0px;
}

.recipe-name {
    text-size: 16px;
    color: #262626;

}

ul {
    display: flex;
    /* Display specs in flex-row */
    /* justify-content: space-between; */
    /* Specs to start and end of row */
}

aside>span,
price-range-component {
    float: left;
    font-size: 12px;
}
</style>
