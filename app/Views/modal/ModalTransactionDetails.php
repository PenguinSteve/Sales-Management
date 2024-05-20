<div class="modal fade" id="printInvoice" tabindex="-1" role="dialog" aria-labelledby="printInvoice" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--header-->
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="inputModalLabel">Invoice</h5>
                    <div class="mt-1 mb-0 d-flex justify-content-between">
                        <p class="mr-3 mb-0">Date</p>
                        <p id="date" class="mb-0">19/05/2024</p>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--enter information-->
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <p>Product</p>
                    <p>Quantity</p>
                    <p>Total</p>

                </div>

                <div class="d-flex justify-content-between">
                    <p>Samsung Galaxy A55</p>
                    <p>1</p>
                    <p>9.000.000</p>
                </div>
            </div>

            <!--footer-->
            <!-- <div class="modal-footer">
                <p></p>
                <p id="totalAmount" class="mb-0 float-end" style="text-align: end">9.000.000 <br><br>
                        Customer&emsp;Nguyen Van A <br>
                        Mobile&emsp;0123456789 <br><br>
                        Employee&emsp;Nguyen Van A
                </p>
            </div> -->

            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <div class="d-flex justify-content-start mb-1">
                        <p style="width: 7rem;">Customer</p>
                        <p>Nguyen Van A</p>
                    </div>

                    <div class="d-flex justify-content-start">
                        <p style="width: 7rem;">Mobile</p>
                        <p>0123456789</p>
                    </div>

                    <div class="d-flex justify-content-start">
                        <p style="width: 7rem;">Employee</p>
                        <p>Nguyen Van A</p>
                    </div>
                </div>

                <div>
                    <p id="totalAmount" style="margin-bottom: 8rem; font-size: large" class="price">9.000.000</p>
                </div>
            </div>
        </div>
    </div>
</div>