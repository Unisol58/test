<template>
<div class="comments">
    <div style="overflow-y:auto; max-height: 200px;">
        <comment-item v-for="comment in comments" :comment="comment" :key="comment.id" />
    </div>
    <hr>
    <div class="reply">
        <div class="input-group mb-3">
            <input type="text" class="form-control" v-model.trim="name" placeholder="Nimi..." maxlength="250" required>
        </div>
        <div class="input-group mb-3">
            <textarea class="form-control" v-model.trim="comment" placeholder="Jäta kommentaar..." maxlength="250" required @keyup.enter="submitComment"></textarea>
        </div>
        <div class="input-group mb-3">
            <button type="button" class="btn btn-outline-primary" @click.prevent="submitComment" :disabled=isDisabled>
                <i class="fa fa-paper-plane primary mr-2"></i> Kommenteeri
            </button>
        </div>

    </div>
</div>
</template>

<script>
export default {
    props: ['comments', 'recipe_id'],
    data() {
        return {
            comment: '',
            name: '',
        }
    },
    methods: {
        submitComment: function() {
            console.log(this.comments)
            var _this = this;
            axios.post('/api/comments', {
                    name: this.name,
                    comment: this.comment,
                    recipe_id: this.recipe_id
                })
                .then(function(response) {
                    _this.addComment(response.data)
                    _this.clearForm()
                })
                .catch(function(error) {
                    console.log(error)
                });

        },

        addComment: function(comment) {
            this.comments.push(comment)
        },

        clearForm: function() {
            this.comment = '',
                this.name = ''
        }
    },
    computed: {
        isDisabled() {
            // evaluate whatever you need to determine disabled here...
            if (this.comment == '' || this.name == '')
                return true

            return false
        }
    }
}
</script>

<style scoped lang="scss">

</style>
