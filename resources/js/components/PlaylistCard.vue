<template>
    <div class="card playlist-card">
        <img v-if="_exists(imageUrl)" class="card-img-top" :src="imageUrl" alt="playlist-cover">
        <div v-else style="font-size: 50px;">X</div>

        <div class="card-body">
            <a v-if="_exists(playlistUrl)" class="card-title" :href="playlistUrl" target="_blank">{{ cardTitle }}</a>
            <p class="card-text">
                Created by: {{ createdBy }}<br>
                Average BPM: TBD<br>
                Danceability: {{ _computeDanceability(danceability) }}
            </p>
            <p v-if="_exists(cardText)" class="card-text">
                {{ cardText }}
            </p>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';

    export default {
        name: 'stat-card',
        props: {
            danceability: String,
            cardText: String,
            user: {
                type: Object,
                required: true
            },
            playlist: {
                type: Object,
                required: true
            }
        },
        methods: {
            _exists(anything) {
                return !_.isNull(anything) && !_.isUndefined(anything) && !_.isEmpty(anything);
            },

            _computeDanceability() {
                if (this._exists(this.danceability)){
                    return this.danceability.toString() + ' out of 1';
                } else {
                    return 'Not available.'
                }
            }
        },

        computed: {
            imageUrl() {
                if (this._exists(this.playlist.images)) {
                    return this.playlist.images[0].url;
                } else {
                    return '';
                }
            },

            playlistUrl() {
                return this.playlist.external_urls.spotify;
            },

            cardTitle() {
                return this.playlist.name;
            },

            createdBy() {
                return this.playlist.owner.display_name;
            }
        },

        mounted() {
            //console.log(this.playlistUrl);
            console.log(this.playlist.images);
        }
    }
</script>
