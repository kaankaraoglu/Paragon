<template>
    <div class="root">
        <div :id="tag" class="tags rounded-pill" v-for="tag in tags" v-on:click="_tagClicked(tag)">
            <span class="tag noselect">
                {{ tag }}
            </span>
        </div>
        <div class="modal fade" id="limitModal" tabindex="-1" role="dialog" aria-labelledby="limitModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        Spotify Web API allows up to 5 genre seeds when giving recommendations.
                        Try to select the ones you think better suits your taste.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Tags",
        props: {
            tags: {}
        },
        data() {
            return {
                selectedTags: [],
            }
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
                    $('#limitModal').modal('show');
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .root {
        margin: 30px 0;

        .tags {
            height: 35px;
            line-height: 35px;
            color: #bfcbd9;
            margin: 0 5px 10px;
            font-size: 13px;
            font-weight: bold;
            background: none;
            border: 1px dashed white;
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

        .modal {
            .modal-dialog {
                .modal-content {
                    background: black;
                    border: 1px solid $spotify-green;

                    .modal-body {
                        padding: 2rem;
                        text-align: left;
                    }
                }
            }
        }
    }
</style>
