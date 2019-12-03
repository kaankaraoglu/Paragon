<template>
    <div class="card-columns">
        <div v-for="playlist in playlists">
            <div v-if="computePublic(playlist)">
                <playlist-card :playlist="playlist"></playlist-card>
            </div>
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

<style lang="scss" scoped></style>
