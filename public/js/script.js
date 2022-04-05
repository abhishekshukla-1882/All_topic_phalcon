console.log("ayagfbsdvbksvnksjksjhvksjdhkjshkjsdkjsdkap");
$(document).ready(function () {

    console.log("hello");
    $("#products").on("click", ".add-to-cart", function (e) {
        e.preventDefault();
        let pid = $(this).data('pid');

        $.ajax({
            method: "POST",
            url: "config.phtml",
            data: { id: pid},
            //  dataType: "JSON"
        }).done(function (data) {
            console.log("aya");
            // console.log("after delete" + data["cart"]);
            // let newdata = JSON.parse(data);
            // console.log(newdata['cart']);
            // let tprice = newdata['tprice'];
            // let tqnty = newdata['tqnty'];
            // console.log(tprice);
            // disply(newdata, tprice, tqnty);

        });
    });
});