<template>
    <div class="root">
        <span class="heading">Generate a playlist by audio features</span>
        <form class="row">
            <div class="col-5 feature-col">
                <div class="form-group">
                    <label for="bpmRange">BPM</label>
                    <div class="row">
                        <input class="col-9 form-control-range" type="range" id="bpmRange" min="0" max="1" step="0.05" v-model="tempoValue">
                        <span class="col-3" >{{ tempo }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="energyRange">Energy</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="energyRange" min="0" max="1" step="0.05" v-model="energyValue">
                        <span class="col-3">{{ energy }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="danceabilityRange">Danceability</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="danceabilityRange" min="0" max="1" step="0.05" v-model="danceabilityValue">
                        <span class="col-3">{{ danceability }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="instrumentalnessRange">Instrumentalness</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="instrumentalnessRange" min="0" max="1" step="0.05" v-model="instrumentalnessValue">
                        <span class="col-3">{{ instrumentalness }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="loudnessRange">Loudness</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="loudnessRange" min="0" max="1" step="0.05" v-model="loudnessValue">
                        <span class="col-3">{{ loudness }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keyRange">Key</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="keyRange" min="0" max="1" step="0.05" v-model="keyValue">
                        <span class="col-3">{{ key }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="acousticnessRange">Acousticness</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="acousticnessRange" min="0" max="1" step="0.05" v-model="acousticnessValue">
                        <span class="col-3">{{ acousticness }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="livenessRange">Liveness</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="livenessRange" min="0" max="1" step="0.05" v-model="livenessValue">
                        <span class="col-3">{{ liveness }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="modeRange">Mode</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="modeRange" min="0" max="1" step="0.05" v-model="modeValue">
                        <span class="col-3">{{ mode }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="popularityRange">Popularity</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="popularityRange" min="0" max="1" step="0.05" v-model="popularityValue">
                        <span class="col-3">{{ popularity }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="speechinessRange">Speechiness</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="speechinessRange" min="0" max="1" step="0.05" v-model="speechinessValue">
                        <span class="col-3">{{ speechiness }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="valenceRange">Valence</label>
                    <div class="row">
                        <input type="range" class="col-9 form-control-range" id="valenceRange" min="0" max="1" step="0.05" v-model="valenceValue">
                        <span class="col-3">{{ valence }}</span>
                    </div>
                </div>
            </div>
            <div class="col-5 offset-2 description-section">
                <p class="description-heading">Audio feature descriptions</p>
                <blockquote class="blockquote text-right">
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer class="blockquote-footer">From <cite title="Source Title">Spotify API</cite></footer>
                </blockquote>
                <button type="submit" class=" align-self-center spotify-button">Generate!</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "PlaylistGenerator",

        data() {
            return {
                tempoValue: 0.5,
                danceabilityValue: 0.5,
                energyValue: 0.5,
                acousticnessValue: 0.5,
                instrumentalnessValue: 0.5,
                livenessValue: 0.5,
                loudnessValue: 0.5,
                keyValue: 0.5,
                modeValue: 0.5,
                popularityValue: 0.5,
                speechinessValue: 0.5,
                valenceValue: 0.5
            }
        },

        computed: {
            tempo: function () { return this.tempoValue; },
            danceability: function () { return this.danceabilityValue; },
            energy: function () { return this.energyValue; },
            acousticness: function () { return this.acousticnessValue; },
            instrumentalness: function () { return this.instrumentalnessValue; },
            liveness: function () { return this.livenessValue; },
            loudness: function () { return this.loudnessValue; },
            key: function () { return this.keyValue; },
            mode: function () { return this.modeValue; },
            popularity: function () { return this.popularityValue; },
            speechiness: function () { return this.speechinessValue; },
            valence: function () { return this.valenceValue; }
        }
    }
</script>

<style lang="scss" scoped>
    .root {
        .heading {
            float: left;
            font-size: 35px;
            font-weight: 600;
        }

        form {
            margin: 0;
            width: 100%;
            padding-top: 3%;

            .feature-col{
                padding: 0;

                .form-group {
                    label {
                        margin: 0;
                        display: block;
                        font-size: 12px;
                        text-align: left;
                        font-weight: bold;
                    }

                    .row{
                        input {
                            margin: 0;
                        }
                    }
                }
            }

            .description-section {
                .description-heading {
                    font-size: 25px;
                    text-align: right;
                    margin-bottom: 50px;
                }

                button {
                    height: 45px;
                    float: right;
                }
            }
        }
    }
</style>
