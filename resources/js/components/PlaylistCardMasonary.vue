<template>
    <div class="card-columns">
        <div v-if="computePublic(playlist)" v-for="playlist in playlists">
            <playlist-card :playlist="playlist"></playlist-card>
        </div>
    </div>
</template>

<script>
    import PlaylistCard from './PlaylistCard';
    export default {
        name: "PlaylistCardMasonary",

        components: {
            PlaylistCard
        },

        props: {
            playlists: Array,
            public: Boolean
        },

        methods: {
            computePublic(playlist) {
                return playlist['public'] === this.public;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @media (min-width: 576px) {
        .card-columns {
            column-count: 3;
        }
    }

    @media (min-width: 768px) {
        .card-columns {
            column-count: 4;
        }
    }

    @media (min-width: 992px) {
        .card-columns {
            column-count: 4;
        }
    }

    @media (min-width: 1200px) {
        .card-columns {
            column-count: 5;
        }
    }

    @media (min-width: 1680px) {
        .card-columns {
            column-count: 6;
        }
    }

    @media (min-width: 2000px) {
        .card-columns {
            column-count: 7;
        }
    }
</style>
