<template>
    <div class="card playlist-card">
        <img v-if="_exists(imageUrl)" class="card-img-top" :src="imageUrl" alt="playlist-cover">
        <div v-else style="font-size: 50px;">No image</div>

        <div class="card-body">
            <a v-if="_exists(playlistUrl)" class="card-title" :href="playlistUrl" target="_blank">{{ cardTitle }}</a>
            <p class="card-text">
                Created by: <b>{{ createdBy }}</b><br><br>
                <b>Average audio features</b><br>

                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="tempoTooltip">
                    BPM: <b>{{ tempo }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="danceabilityTooltip">
                    Danceability: <b>{{ danceability }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="energyTooltip">
                    Energy: <b>{{ energy }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="acousticnessTooltip">
                    Acousticness: <b>{{ acousticness }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="instrumentalnessTooltip">
                    Instrumentalness: <b>{{ instrumentalness }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="livenessTooltip">
                    Liveness: <b>{{ liveness }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="loudnessTooltip">
                    Loudness: <b>{{ loudness }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="modeTooltip">
                    Mode: <b>{{ mode }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="speechinessTooltip">
                    Speechiness: <b>{{ speechiness }}</b>
                </span><br>
                <span class="d-inline-block audio-feature" tabindex="0" data-toggle="tooltip" :title="valenceTooltip">
                    Valence: <b>{{ valence }}</b>
                </span>
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
        name: 'playlist-card',
        props: {
            features: Object,
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
            },

            tempo() {
                return this.features.tempo;
            },

            danceability() {
                return this.features.danceability;
            },

            energy() {
                return this.features.energy;
            },

            acousticness() {
                return this.features.acousticness;
            },

            instrumentalness() {
                return this.features.instrumentalness;
            },

            liveness() {
                return this.features.liveness;
            },

            loudness() {
                return this.features.loudness;
            },

            mode() {
                return this.features.mode;
            },

            speechiness() {
                return this.features.speechiness;
            },

            valence() {
                return this.features.valence;
            },

            tempoTooltip() {
                return 'The overall estimated tempo of a track in beats per minute (BPM). In musical terminology, tempo is the speed or pace of a given piece and derives directly from the average beat duration.';
            },

            danceabilityTooltip() {
                return 'Danceability describes how suitable a track is for dancing based on a combination of musical elements including tempo, rhythm stability, beat strength, and overall regularity. A value of 0.0 is least danceable and 1.0 is most danceable.';
            },

            energyTooltip() {
                return 'Energy is a measure from 0.0 to 1.0 and represents a perceptual measure of intensity and activity. Typically, energetic tracks feel fast, loud, and noisy. For example, death metal has high energy, while a Bach prelude scores low on the scale. Perceptual features contributing to this attribute include dynamic range, perceived loudness, timbre, onset rate, and general entropy.';
            },

            acousticnessTooltip() {
                return 'A confidence measure from 0.0 to 1.0 of whether the track is acoustic. 1.0 represents high confidence the track is acoustic.';
            },

            instrumentalnessTooltip() {
                return 'Predicts whether a track contains no vocals. “Ooh” and “aah” sounds are treated as instrumental in this context. Rap or spoken word tracks are clearly “vocal”. The closer the instrumentalness value is to 1.0, the greater likelihood the track contains no vocal content. Values above 0.5 are intended to represent instrumental tracks, but confidence is higher as the value approaches 1.0.';
            },

            livenessTooltip() {
                return 'Detects the presence of an audience in the recording. Higher liveness values represent an increased probability that the track was performed live. A value above 0.8 provides strong likelihood that the track is live.';
            },

            loudnessTooltip() {
                return 'The overall loudness of a track in decibels (dB). Loudness values are averaged across the entire track and are useful for comparing relative loudness of tracks. Loudness is the quality of a sound that is the primary psychological correlate of physical strength (amplitude). Values typical range between -60 and 0 db.';
            },

            modeTooltip() {
                return 'Mode indicates the modality (major or minor) of a track, the type of scale from which its melodic content is derived. Major is represented by 1 and minor is 0.';
            },

            speechinessTooltip() {
                return 'Speechiness detects the presence of spoken words in a track. The more exclusively speech-like the recording (e.g. talk show, audio book, poetry), the closer to 1.0 the attribute value. Values above 0.66 describe tracks that are probably made entirely of spoken words. Values between 0.33 and 0.66 describe tracks that may contain both music and speech, either in sections or layered, including such cases as rap music. Values below 0.33 most likely represent music and other non-speech-like tracks.';
            },

            valenceTooltip() {
                return 'A measure from 0.0 to 1.0 describing the musical positiveness conveyed by a track. Tracks with high valence sound more positive (e.g. happy, cheerful, euphoric), while tracks with low valence sound more negative (e.g. sad, depressed, angry).';
            },
        },

        mounted() {
            // Initialize tooltips
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
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

        .card-body {
            background: $bg-light;
            text-align: left;

            .card-title {
                font-size: 14px;
                font-weight: bold;
                text-decoration: none;
                color: $spotifyGreen;
            }

            .card-text {
                font-size: 12px;
            }
        }
    }
</style>
