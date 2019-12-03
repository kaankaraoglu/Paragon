<template>
    <div class="modal fade" id="limitModal" tabindex="-1" role="dialog" aria-labelledby="limitModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ modalTitle }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ modalBody }}
                </div>
                <div v-if="_exists(playlist)">
                    <playlist-card class="modal-playlist-card" :playlist="playlist"></playlist-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PlaylistCard from "./PlaylistCard";

    export default {
        name: "Modal",

        components: {
            PlaylistCard
        },

        props: {
            modalTitle: String,
            modalBody: String,
            playlist: Object
        },

        methods: {
            _exists(anything) {
                return !_.isUndefined(anything) && !_.isNull(anything) && !_.isEmpty(anything);
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';
    .modal {
        .modal-dialog {
            .modal-content {
                background: black;
                border: 1px solid $spotify-green;

                .modal-header {
                    border: none;
                    padding: 1rem 1rem 0;

                    .modal-title {
                        padding: 1rem 1rem 0;
                    }

                    .close {
                        opacity: 1;
                        color: white;
                        text-shadow: none;
                        font-size: 1.5rem;
                    }
                }

                .modal-body {
                    padding: 0 2rem 2rem;
                    text-align: left;
                }

                .modal-playlist-card {
                    border-radius: 20px;
                    margin: 10px 100px 20px;
                }
            }
        }
    }
</style>
