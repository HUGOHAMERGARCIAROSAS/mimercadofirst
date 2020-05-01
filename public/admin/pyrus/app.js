function changeOrder(value, id, url) {
    let data = {
        'position': value,
        'id': id,
    };

    $.ajax({
        url: url,
        method: 'POST',
        data: data,
    }).done((response) => {
        toastr[response.type](response.message);
        // toastr['success'](response.message);
    }).fail((error) => {
        console.log(error);
    });
}

function updateColumn(value, id, column, url) {
    let data = {
        value: value.trim(),
        column: column,
        "name": value.trim(),
        id: id,
    };

    $.ajax({
        url: url,
        method: 'POST',
        dataType : "JSON",
        data: data,
    }).done((response) => {
        toastr[response.type](response.message);
    }).fail((error) => {
        let errors = error.responseJSON;
        $.each(errors.errors, function( key, value ) {
            toastr['error'](value[0]);
        });
        console.log(error);
    });

}

function update(data, url) {
    return $.ajax({
        url: url,
        method: 'POST',
        dataType : "JSON",
        data: data,
    }).done((response) => {
        toastr[response.type](response.message);
    }).fail((error) => {
        let errors = error.responseJSON;
        $.each(errors.errors, function( key, value ) {
            toastr['error'](value[0]);
        });
        console.log(error);
    });

}

function updateAvailable(value, id, url) {
    let data =  {
        value: value,
        id: id,
    };

    return $.ajax({
        url: url,
        method: 'POST',
        dataType : "JSON",
        data: data,
    }).done((response) => {
        toastr[response.type](response.message);
    }).fail((error) => {
        let errors = error.responseJSON;
        $.each(errors.errors, function( key, value ) {
            toastr['error'](value[0]);
        });

        console.log(error);
    });
}

function searchSubCategory(categoryId, url) {
    let data = {
        'categoryId': categoryId,
    };

    return $.ajax({
        url: url,
        method: 'POST',
        dataType : "JSON",
        data: data,
    }).done((response) => {
        $('#sub_category_id').html(response.viewSubCategories);

        $('#product_sub_category_id').html('<option value="">Seleccione</option>');
    }).fail((error) => {
        console.log(error);
    });
}

function searchSubCategory2(subCategoryId, url) {
    let data = {
        'subCategoryId': subCategoryId,
    };

    return $.ajax({
        url: url,
        method: 'POST',
        dataType : "JSON",
        data: data,
    }).done((response) => {
        console.log(response);
        $('#product_sub_category_id').html(response.viewSubCategories);
    }).fail((error) => {
        console.log(error);
    });
}