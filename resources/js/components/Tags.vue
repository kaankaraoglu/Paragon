<template>
    <div class="tags-root">
        <div :id="tag" class="tags rounded-pill" v-for="tag in tags" v-on:click="_tagClicked(tag)">
            <span class="noselect">
                {{ tag }}
            </span>
        </div>
        <modal id="tagsModal" :modal-title="tagsModalTitle" :modal-body="tagsModalBody"></modal>
    </div>
</template>

<script>
    import Modal from './Modal';
    export default {
        name: "Tags",
        props: {
            tags: {}
        },
        components: {
            Modal
        },
        data() {
            return {
                selectedTags: [],
                tagsModalTitle: '',
                tagsModalBody: ''
            }
        },
        updated(){
            $('.tags.active').removeClass('active');
            this.selectedTags.forEach(tag => {
                $('.tags' + '#' + tag).addClass('active');
            });
        },
        methods: {
            _tagClicked(tag) {
                let tagId = $('#' + tag);
                if($('.tags.active').length <= 4 || tagId.hasClass('active')){
                    if (!tagId.hasClass('active')){
                        tagId.addClass('active');
                        this.selectedTags.push(tag);
                    } else {
                        tagId.removeClass('active');
                        _.pull(this.selectedTags, tag);
                    }
                    this.$emit('clicked', this.selectedTags);
                } else {
                    this.tagsModalTitle = 'Warning!';
                    this.tagsModalBody = 'You can select maximum of 5 genres.';
                    $('#tagsModal').modal('show');
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';
    @import '../../sass/mixins';

    .tags-root {
        width: 100%;
        align-content: flex-start;
        justify-content: center;

        .tags {
            height: 35px;
            line-height: 35px;
            color: #bfcbd9;
            margin: 0 5px 10px;
            font-size: 13px;
            font-weight: bold;
            background: none;
            border: 1px solid white;
            text-align: center;
            padding: 0 15px;
            cursor: pointer;
        }

        .tags.active {
            color: black;
            border: 1px solid $spotify-green;
            background: $spotify-green;
        }

        .noselect {
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Old versions of Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently supported by Chrome, Opera and Firefox */
        }
    }
</style>
