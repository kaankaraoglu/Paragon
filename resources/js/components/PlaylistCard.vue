<template>
    <div class="card playlist-card">
        <img v-if="_exists(imageUrl)" class="card-img-top" alt="playlist-cover" :src="imageUrl"/>
        <div v-else class="no-image">No image</div>

        <div class="card-body">
            <a v-if="_exists(playlistUrl)" class="card-title" :href="playlistUrl" target="_blank">{{ cardTitle }}</a>
            <a v-else class="card-title" href="#" target="_blank">{{ cardTitle }}</a>

            <vcl-list v-if="!_exists(features)" class="placeholder-list" primary="#282828" secondary="#111111"></vcl-list>
            <p v-else class="card-text">
                Created by: <b>{{ createdBy }}</b>
                <br><br>
                <b>Average audio features</b>
                <br><br>
                <span class="d-block audio-feature" v-for="(value, name) in features">
                    {{ _beautifyFeatureName(name) }} <b class="audio-feature-value">{{ value }}</b>
                </span>
            </p>
            <p v-if="_exists(cardText)" class="card-text">
                {{ cardText }}
            </p>
            <a :href="playlistUrl" class="spotify-button rounded-pill" target="_blank">Play on Spotify</a>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import { VclList } from 'vue-content-loading';

    export default {
        name: 'playlist-card',
        components: {
            VclList
        },
        props: {
            cardText: String,
            playlist: {
                type: Object,
                required: true
            }
        },

        data() {
            return {
                features: [],
                availableFeatures: 'tempo, danceability, energy, acousticness, instrumentalness, liveness, loudness, mode, speechiness, valence',
                featureTooltips: {
                    'tempo': 'The overall estimated tempo of a track in beats per minute (BPM). In musical terminology, tempo is the speed or pace of a given piece and derives directly from the average beat duration.',
                    'danceability': 'Danceability describes how suitable a track is for dancing based on a combination of musical elements including tempo, rhythm stability, beat strength, and overall regularity. A value of 0.0 is least danceable and 1.0 is most danceable.',
                    'energy': 'Energy is a measure from 0.0 to 1.0 and represents a perceptual measure of intensity and activity. Typically, energetic tracks feel fast, loud, and noisy. For example, death metal has high energy, while a Bach prelude scores low on the scale. Perceptual features contributing to this attribute include dynamic range, perceived loudness, timbre, onset rate, and general entropy.',
                    'acousticness': 'A confidence measure from 0.0 to 1.0 of whether the track is acoustic. 1.0 represents high confidence the track is acoustic.',
                    'instrumentalness': 'Predicts whether a track contains no vocals. “Ooh” and “aah” sounds are treated as instrumental in this context. Rap or spoken word tracks are clearly “vocal”. The closer the instrumentalness value is to 1.0, the greater likelihood the track contains no vocal content. Values above 0.5 are intended to represent instrumental tracks, but confidence is higher as the value approaches 1.0.',
                    'liveness': 'Detects the presence of an audience in the recording. Higher liveness values represent an increased probability that the track was performed live. A value above 0.8 provides strong likelihood that the track is live.',
                    'loudness': 'The overall loudness of a track in decibels (dB). Loudness values are averaged across the entire track and are useful for comparing relative loudness of tracks. Loudness is the quality of a sound that is the primary psychological correlate of physical strength (amplitude). Values typical range between -60 and 0 db.',
                    'mode': 'Mode indicates the modality (major or minor) of a track, the type of scale from which its melodic content is derived. Major is represented by 1 and minor is 0.',
                    'speechiness': 'Speechiness detects the presence of spoken words in a track. The more exclusively speech-like the recording (e.g. talk show, audio book, poetry), the closer to 1.0 the attribute value. Values above 0.66 describe tracks that are probably made entirely of spoken words. Values between 0.33 and 0.66 describe tracks that may contain both music and speech, either in sections or layered, including such cases as rap music. Values below 0.33 most likely represent music and other non-speech-like tracks.',
                    'valence': 'A measure from 0.0 to 1.0 describing the musical positiveness conveyed by a track. Tracks with high valence sound more positive (e.g. happy, cheerful, euphoric), while tracks with low valence sound more negative (e.g. sad, depressed, angry).',
                    'key': 'The key the track is in. Integers map to pitches using standard Pitch Class notation. 0 = C, 1 = C♯/D♭, 2 = D, 3 = D♯, E♭ (also Fdouble flat), 4 = E (also Ddouble sharp, F♭), 5 = F (also E♯, Gdouble flat), 6 = F♯, G♭ (also Edouble sharp), 7 = G (also Fdouble sharp, Adouble flat), 8 = G♯, A♭, 9 = A (also Gdouble sharp, Bdouble flat), 10, t or A = A♯, B♭ (also Cdouble flat), 11, e or B = B (also Adouble sharp, C♭)',
                    'popularity': 'The popularity of the track. The value will be between 0 and 100, with 100 being the most popular. The popularity is calculated by algorithm and is based, in the most part, on the total number of plays the track has had and how recent those plays are.'
                }
            }
        },

        mounted() {
            this._getPlaylistData();
        },

        methods: {
            _computeTooltip(feature){
                return this.featureTooltips[feature];
            },

            _exists(anything) {
                return !_.isNull(anything) && !_.isUndefined(anything) && !_.isEmpty(anything);
            },

            _getPlaylistData(){
                let endpoint = 'api/get-audio-features?playlist_id=' + this.playlist.id + '&features=' + 'all'; //this.availableFeatures.replace(/\s/g, '')
                axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
                axios.post(endpoint)
                    .then((response) => {
                        this.features = response.data;
                    })
                    .catch(function (error) {
                        //console.log(error.response);
                    })
                    .finally(function () {
                        // always executed
                    });
            },

            _beautifyFeatureName(featureName) {
                if (featureName === 'tempo'){
                    return featureName = 'BPM';
                } else {
                    return _.capitalize(featureName);
                }
            }
        },

        computed: {
            imageUrl() {
                return this._exists(this.playlist.images) ? this.playlist.images[0].url : '';
            },

            playlistUrl() {
                if (!_.isUndefined(this.playlist.external_urls.spotify)){
                    return this.playlist.external_urls.spotify;
                }
            },

            cardTitle() {
                return this.playlist.name;
            },

            createdBy() {
                return this.playlist.owner.display_name;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .audio-feature {
        cursor: pointer;
    }

    .playlist-card {
        background: none;

        .no-image {
            font-size: 50px;
        }

        .card-body {
            background: #111;
            text-align: left;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;

            .placeholder-list {
                margin: 30px 0 20px;
            }

            .card-title {
                font-size: .7rem;
                font-weight: bold;
                text-decoration: none;
                color: $spotify-green;
            }

            .card-text {
                font-size: .7rem;

                .audio-feature-value{
                    float: right;
                }
            }

            .spotify-button {
                width: 100%;
                text-align: center;
            }
        }
    }
</style>
