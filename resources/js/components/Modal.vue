<template>
    <div class="modal fade" id="limitModal" tabindex="-1" role="dialog" aria-labelledby="limitModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ modalText }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal",
        props: {
            modalText: String
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

                .modal-body {
                    padding: 2rem;
                    text-align: left;
                }
            }
        }
    }
</style>
