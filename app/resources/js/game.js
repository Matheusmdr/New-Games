$(document).ready(function () {
    $(".add_game_btn").click(function (e) {
        e.preventDefault();
        var $form = $(this).closest(".add-game-form");
        var name = $form.find('#name').val()
        var email = $form.find('#email').val()
        var sec_email = $form.find('#sec-email').val()
        var phone = $form.find('#phone').val()
        var sec_phone = $form.find('#sec-phone').val()
        var website = $form.find('#website').val()
        var fee = $form.find('#feeVal').val()
        var cat_name = $form.find('#category').val()
        var cat_desc = $form.find('#category-desc').val()
        var game_name = $form.find('#game_name').val()
        var price = $form.find('#price').val()
        var file = new FormData()

        files = $form.find('#image');
        var formData = new FormData(),
            file = [];

        $.each(files, function (key, val) {
            file[key] = val;
        });

        formData.append('file', file);

        var object = {
            'name': name,
            'price': price,
            'email': email,
            'sec_email': sec_email,
            'phone': phone,
            'sec_phone': sec_phone,
            'website': website,
            'fee': fee,
            'cat_name': cat_name,
            'cat_desc': cat_desc,
            'game_name': game_name,
            'file': formData
        }

        addGame(object);
    })


    function addGame(object) {
        $.ajax({
            url: "http://localhost/New-Games/app/Model/Ajax.php", //the page containing php script
            type: "post", //request type,
            contentType: false,
            processData: false,
            data: {
                class: "Product",
                method: "setProduct",
                params: Array(object)
            },
            success: function (response) {
                $("#message11").html(response);
            }
        });
    }
});