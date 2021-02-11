function deleteItem(ID) {
    $.confirm({
        title: null,
        content: "¿Realmente desea eliminar este registro?",
        buttons: {
            delete: {
                text: "Eliminar",
                btnClass: "btn-danger",
                action: function() {
                    // Ajax para eliminar el registro
                    $.ajax({
                        url: `[URL_DELETE]/${ID}`,
                        type: "DELETE",
                        success(res) {
                            if (res) {
                                $.alert("Registro eliminado!");
                                table.ajax.reload();
                            } else
                                $.alert("Error al intentar eliminar el registro, por favor contactar con su administrador.");
                        }
                    });
                }
            },
            cancelar() {},
        }
    });
}

/* Cuando el documento termine de cargar */
$(document).ready(function() {
    window["table"] = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        language: { url: "/i18n/datatables-spanish.json" },
        ajax: {
            url: "[PATH_AJAX]",
            type: "POST",
            dataType: "json",
            data(d) {
                return JSON.stringify(d);
            }
        },
        columnDefs: [
            {
                targets: 0,
                width: "20px"
            },
            { "className": "text-center", "targets": [0] },
        ],
        columns: [
            { data: "id" },
            {
                data(data) {
                    return `<a href="[URL_FORM]/${data.id}" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details"><i class="fas fa-pencil-alt"></i>
                            <a href="javascript:void(0);" onclick="deleteItem(${data.id})" class="btn btn-sm btn-clean btn-icon" title="Eliminar"><i class="far fa-trash-alt"></i>`
                }
            }
        ]
    });
});

