<template>
    <div class="playlist-generator-root">
        <form class="form" @submit.prevent="_submitForm">
            <div class="playlist-generator-start" v-if="step === 1">
                <span class="heading">Generate playlists using audio features and genres</span>
                <a class="spotify-button rounded-pill" v-on:click="_next">Start!</a>
            </div>
            <div id="features" class="form-group-container row" v-if="step === 2">
                <span class="heading">Step 1: Adjust audio features</span>
                <div class="col-3 feature-col">
                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="bpmRange">BPM</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.tempoState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.tempoState }">
                                <p class="feature-description">{{ featureTooltips['tempo'] }}</p>
                                <input class="form-control-range" name="tempoValue" type="range" id="bpmRange" min="75" max="180" step="5" v-model="formData.tempoValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ tempo }}</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="energyRange">Energy</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.energyState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.energyState }">
                                <p class="feature-description">{{ featureTooltips['energy'] }}</p>
                                <input class="form-control-range" name="energyValue" type="range" id="energyRange" min="0" max="1" step="0.05" v-model="formData.energyValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ energy }}</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="danceabilityRange">Danceability</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.danceabilityState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.danceabilityState }">
                                <p class="feature-description">{{ featureTooltips['danceability'] }}</p>
                                <input class="form-control-range" name="danceabilityValue" type="range" id="danceabilityRange" min="0" max="1" step="0.05" v-model="formData.danceabilityValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ danceability }}</div>
                    </div>
                </div>

                <div class="col-3 feature-col">
                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="speechinessRange">Speechiness</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.speechinessState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.speechinessState }">
                                <p class="feature-description">{{ featureTooltips['speechiness'] }}</p>
                                <input class="form-control-range" name="speechinessValue" type="range" id="speechinessRange" min="0" max="1" step="0.05" v-model="formData.speechinessValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ speechiness }}</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="livenessRange">Liveness</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.livenessState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.livenessState }">
                                <p class="feature-description">{{ featureTooltips['liveness'] }}</p>
                                <input class="form-control-range" name="livenessValue" type="range" id="livenessRange" min="0" max="1" step="0.05" v-model="formData.livenessValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ liveness }}</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="acousticnessRange">Acousticness</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.acousticnessState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.acousticnessState }">
                                <p class="feature-description">{{ featureTooltips['acousticness'] }}</p>
                                <input class="form-control-range" name="acousticnessValue" type="range" id="acousticnessRange" min="0" max="1" step="0.05" v-model="formData.acousticnessValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ acousticness }}</div>
                    </div>
                </div>

                <div class="col-3 feature-col">
                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="instrumentalnessRange">Instrumentalness</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.instrumentalnessState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.instrumentalnessState }">
                                <p class="feature-description">{{ featureTooltips['instrumentalness'] }}</p>
                                <input class="form-control-range" name="instrumentalnessValue" type="range" id="instrumentalnessRange" min="0" max="1" step="0.05" v-model="formData.instrumentalnessValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ instrumentalness }}</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="loudnessRange">Loudness</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.loudnessState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.loudnessState }">
                                <p class="feature-description">{{ featureTooltips['loudness'] }}</p>
                                <input class="form-control-range" name="loudnessValue" type="range" id="loudnessRange" min="-60" max="0" step="1" v-model="formData.loudnessValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ loudness }}</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="modeRange">Mode</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.modeState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.modeState }">
                                <p class="feature-description">{{ featureTooltips['mode'] }}</p>
                                <input class="form-control-range" name="modeValue" type="range" id="modeRange" min="0" max="1" step="1" v-model="formData.modeValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ mode }}</div>
                    </div>
                </div>

                <div class="col-3 feature-col">
                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="popularityRange">Popularity</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.popularityState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.popularityState }">
                                <p class="feature-description">{{ featureTooltips['popularity'] }}</p>
                                <input class="form-control-range" name="popularityValue" type="range" id="popularityRange" min="0" max="100" step="5" v-model="formData.popularityValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ popularity }}</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="keyRange">Key</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.keyState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.keyState }">
                                <p class="feature-description">{{ featureTooltips['key'] }}</p>
                                <input class="form-control-range" name="keyValue" type="range" id="keyRange" min="0" max="11" step="1" v-model="formData.keyValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ key }}</div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <div class="feature-name-state">
                                <label class="feature-label" for="valenceRange">Valence</label>
                                <toggle-button color="#1DD760" :sync="true" v-model="inputState.valenceState" :labels="{checked: 'On', unchecked: 'Off'}"/>
                            </div>
                            <div v-bind:class="{ lowOpacity: !inputState.valenceState }">
                                <p class="feature-description">{{ featureTooltips['valence'] }}</p>
                                <input class="form-control-range" name="valenceValue" type="range" id="valenceRange" min="0" max="1" step="0.05" v-model="formData.valenceValue">
                            </div>
                        </div>
                        <div class="col-2 feature-value">{{ valence }}</div>
                    </div>
                </div>
                <div class="button-row">
                    <a class="spotify-button rounded-pill" v-on:click="_prev">Previous</a>
                    <a class="spotify-button rounded-pill" v-on:click="_next">Next</a>
                </div>
            </div>
            <div id="tags" v-if="step === 3">
                <span class="heading">Step 2: Select genre seeds</span>
                <tags :modal-title="tagsModalTitle" :modal-body="tagsModalBody" class="tags row" :tags="genres" @clicked="_onTagClicked"></tags>
                <div class="button-row">
                    <a class="spotify-button rounded-pill" v-on:click="_prev">Previous</a>
                    <button class="spotify-button rounded-pill" type="submit">Generate!</button>
                </div>
            </div>
        </form>
        <modal id="status-modal" modal-title="Warning!" :modal-body="warningModalBody"></modal>
    </div>
</template>

<script>
    import Tags from "./Tags";
    export default {
        name: "PlaylistGenerator",
        components: {
            Tags
        },

        created() {
            this._getAllGenres();
        },

        data() {
            return {
                step: 1,
                genres: {},
                childSelectedTags: {},
                tagsModalTitle: 'Warning!',
                tagsModalBody: 'Spotify Web API allows up to 5 genre seeds when giving recommendations. Try to select the ones you think better suits your taste. You don\'t have to select 5.',
                warningModalBody: 'Status: Not available.',
                formData: {
                    tempoValue: 120,
                    danceabilityValue: 0.5,
                    energyValue: 0.5,
                    acousticnessValue: 0.5,
                    instrumentalnessValue: 0.5,
                    livenessValue: 0.5,
                    loudnessValue: 0.5,
                    keyValue: 10,
                    modeValue: 1,
                    popularityValue: 60,
                    speechinessValue: 0.5,
                    valenceValue: 0.5
                },

                inputState: {
                    tempoState: true,
                    danceabilityState: false,
                    energyState: true,
                    acousticnessState: true,
                    instrumentalnessState: false,
                    livenessState: false,
                    loudnessState: false,
                    keyState: false,
                    modeState: false,
                    popularityState: false,
                    speechinessState: false,
                    valenceState: false
                },

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

        computed: {
            selectedTags: function () { return this.childSelectedTags[0]; },
            tempo: function () { return this.formData.tempoValue; },
            danceability: function () { return this.formData.danceabilityValue; },
            energy: function () { return this.formData.energyValue; },
            acousticness: function () { return this.formData.acousticnessValue; },
            instrumentalness: function () { return this.formData.instrumentalnessValue; },
            liveness: function () { return this.formData.livenessValue; },
            loudness: function () { return this.formData.loudnessValue; },
            key: function () { return this.formData.keyValue; },
            mode: function () { return this.formData.modeValue; },
            popularity: function () { return this.formData.popularityValue; },
            speechiness: function () { return this.formData.speechinessValue; },
            valence: function () { return this.formData.valenceValue; }
        },

        methods: {
            _getAllGenres(){
                let endpoint = 'api/get-all-genres';
                axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
                axios.post(endpoint)
                    .then((response) => {
                        this.genres = response.data.genres;
                    })
                    .catch(function (error) {
                        console.log(error.response);
                    });
            },

            _prev() {
                this.step--;
            },

            _next() {
                this.step++;
            },

            _onTagClicked(value) {
                this.childSelectedTags = [];
                this.childSelectedTags.push(value);
            },

            _submitForm(e) {
                e.preventDefault();

                // check if any genres are selected.
                // At least 1 required.
                if (_.isEmpty(this.selectedTags)){
                    this.warningModalBody = 'You should select at least one genre to create a playlist.';
                    $('#status-modal').modal('show');
                    return;
                }

                let params = {
                    'formData': this.formData,
                    'inputState': this.inputState,
                    'genres': this.selectedTags
                };

                let that = this;
                let endpoint = 'api/generate-tracks';
                axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
                axios.post(endpoint, params)
                    .then(function (response) {
                        if(response.status === 200){
                            that.warningModalBody = 'Playlist successfully created!';
                        }
                    })
                    .catch(function (error) {
                        that.warningModalBody = 'Couldn\'t create playlist.';
                        console.log(error);
                    })
                    .finally(function () {
                        $('#status-modal').modal('show');
                    });
            },
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .playlist-generator-root {

        .heading {
            width: 100%;
            float: left;
            margin-bottom: 75px;
            font-size: 45px;
            font-weight: 600;
        }

        a.spotify-button {
            width: 140px;
        }

        .form {
            margin: 0;
            width: 100%;

            .form-group-container {
                min-height: 575px;

                .feature-col {
                    margin: 0 auto;

                    .form-group {
                        margin-bottom: 50px;

                        .feature-name-state {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 10px;

                            .vue-js-switch {
                                margin: 0;
                                border-radius: 11px;
                                background: $spotify-green;

                                .v-switch-label {
                                    color: #000 !important;
                                }
                            }

                            .feature-label {
                                margin: 0;
                                display: block;
                                font-size: 14px;
                                text-align: left;
                                font-weight: bold;
                            }
                        }

                        .feature-description {
                            font-size: 10px;
                            text-align: justify;
                        }

                        .form-control-range {
                            width: 100%;
                            margin: 0;
                        }

                        .feature-value {
                            display: flex;
                            font-weight: bold;
                            align-items: flex-end;
                            justify-content: left;
                            padding: 0;
                        }
                    }
                }
            }

            .tags {
                min-height: 575px;
                padding: 0 22%;
            }
        }

        .button-row {
            display: flex;
            justify-content: space-around;

            .spotify-button {
                width: 140px;
                margin: 0 auto;
            }
        }

        .lowOpacity {
            opacity: 0.1;
        }
    }
</style>
