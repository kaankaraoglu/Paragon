<template>
    <div class="root">
        <span class="heading">Generate a playlist by audio features</span>
        <form class="row">
            <div class="col-3 feature-col">
                <div class="form-group">
                    <label for="bpmRange">BPM</label>
                    <input type="range" ref="el" class="form-control-range" id="bpmRange" min="0" max="1" step="0.05" value="0.5">
                </div>
                <div class="form-group">
                    <label for="energyRange">Energy</label>
                    <input type="range" ref="el" class="form-control-range" id="energyRange" min="0" max="1" step="0.05" value="0.5">
                </div>
                <div class="form-group">
                    <label for="danceabilityRange">Danceability</label>
                    <input type="range" ref="el" class="form-control-range" id="danceabilityRange" min="0" max="1" step="0.05" value="0.5">
                </div>
                <div class="form-group">
                    <label for="instrumentalnessRange">Instrumentalness</label>
                    <input type="range" ref="el" class="form-control-range" id="instrumentalnessRange" min="0" max="1" step="0.05" value="0.5">
                </div>
                <div class="form-group">
                    <label for="loudnessRange">Loudness</label>
                    <input type="range" ref="el" class="form-control-range" id="loudnessRange" min="0" max="1" step="0.05" value="0.5">
                </div>
            </div>
            <div class="col-3 feature-col">
                <div class="form-group">
                    <label for="acousticnessRange">Acousticness</label>
                    <input type="range" ref="el" class="form-control-range" id="acousticnessRange" min="0" max="1" step="0.05" value="0.5">
                </div>
                <div class="form-group">
                    <label for="livenessRange">Liveness</label>
                    <input type="range" ref="el" class="form-control-range" id="livenessRange" min="0" max="1" step="0.05" value="0.5">
                </div>
            </div>
            <div class="col-4">
                <div class="card description-card">
                    <div class="card-header">
                        Description
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Generator",

        mounted(){
            this.$refs['el'].value = 0.5;
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

        .row {
            margin-top: 50px;
            width: 100%;

            .feature-col {
                padding-top: 3%;
                
                &:not(:first-child){
                    padding-left: 4%;
                    padding-right: 4%;
                }

                label {
                    margin: 0;
                    float: left;
                    font-size: 12px;
                    font-weight: bold;
                }
            }

            .description-card {
                background: none;
                color: white;
            }
        }
    }
</style>
