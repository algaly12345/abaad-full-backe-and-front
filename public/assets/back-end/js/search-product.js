'use strict';
$('.search-business-chart').on('keyup',function (){
    let name = $(this).val();
    if (name.length > 0) {
        $.get($('#get-search-business-chart-route').data('action'), {searchValue: name}, (response) => {
            $('.search-result-box').empty().html(response.result);
        })
    }
})
let selectProductSearch = $('.select-business-chart-search');
selectProductSearch.on('click', '.select-business-chart-item', function () {
    let productName = $(this).find('.business-chart-name').text();
    let productId = $(this).find('.business-chart-id').text();
    selectProductSearch.find('button.dropdown-toggle').text(productName);
    $('.product_id').val(productId);
})
