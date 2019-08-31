<template>
    <li>
        <a @click="showDepositModal">
            <i class="icon-cash3 position-left"></i>
            واریز
        </a>
        <!-- Deposit Modal -->
        <div id="depositModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content bg-teal-300">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">درخواست واریز</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button class="btn bg-teal-300">
                                    <i class="icon-rotate-cw2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-white" data-dismiss="modal">خروج</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Deposit Modal -->
    </li>
</template>

<script>
    export default {
        name: "deposit",

        data() {
            return {}
        },

        methods: {
            showDepositModal() {
                $('#depositModal').modal('show')
            }
        }
    }
</script>

<style scoped>

</style>