<div class="modal fade" id="InvoiceModal" tabindex="-1" role="dialog" aria-labelledby="InvoiceModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--header-->
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="inputModalLabel">Invoice</h5>
                    <div class="mt-1 mb-0 d-flex justify-content-between">
                        <p class="mr-3 mb-0">Date</p>
                        <p id="date" class="mb-0 nunito"></p>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--enter information-->
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <p>Product ID</p>
                    </div>
                    <div class="col">
                        <p>Product</p>
                    </div>
                    <div class="col">
                        <p class="text-center">Quantity</p>
                    </div>
                    <div class="col">
                        <p class="text-center">Unit price</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <div class="d-flex justify-content-start mb-1">
                        <p style="width: 7rem;">Customer</p>
                        <p id="customerName"></p>
                    </div>

                    <div class="d-flex justify-content-start">
                        <p style="width: 7rem;">Mobile</p>
                        <p id="customerPhone" class="nunito"></p>
                    </div>

                    <div class="d-flex justify-content-start">
                        <p style="width: 7rem;">Employee</p>
                        <p id="staffName"></p>
                    </div>
                </div>

                <div>
                    <p id="totalAmountModal" style="margin-bottom: 8rem; font-size: large" class="price nunito mt-4"></p>
                </div>
            </div>
        </div>
    </div>
</div>