$(function () {
    document.getElementById("pasa").disabled = true;
    var fechas = [];
    var dateRange = [];
    var bDates = [];
    let jsonObject = {};
    var new_fecha_datepicker;
    $.ajax({
        method: "GET",
        url: "http://127.0.0.1:8000/api/tipo_terapias?page=1",
        dataType: "json",
        data: jsonObject
    }).done(function (data) {
        console.log(data);
        for (let i = 0; i < data.length; i++) {
            $(".terapia").append($("<option class='option_terapia'>").attr('value', data[i].id).text(data[i].nombreTerapia));

        }
        $('.terapia').removeAttr('disabled');

        $(".terapia").change(function () {
            $('.servicio').attr('disabled', 'disabled');
            $('.option_servicio').remove()
            var turno = $('.terapia :selected').val();
            $(".wlly").remove();
            console.log(turno);
            $.ajax({
                method: "GET",
                url: "http://127.0.0.1:8000/get_servicios/" + turno,
                dataType: "json",
                data: jsonObject
            }).done(function (data) {
                for (let i = 0; i < data.servicios_a.length; i++) {
                    $(".servicio").append($("<option class='option_servicio'>").attr('value', data.servicios_a[i].id).text(data.servicios_a[i].nombre_servicio));
                }
                $('.servicio').removeAttr('disabled');
                console.log(data.servicios_a[0].nombre_servicio);

            });
        })


    })



    $(".servicio").change(function () {
        $('#datepicker').removeAttr('disabled');
        $.ajax({
            url: 'http://127.0.0.1:8000/reservar_cita',
            async: false,
            success: function (data) {
                fechas = JSON.parse(data)["fechas"];
                console.log(fechas);
                if (fechas != undefined) {
                    for (let i = 0; i < fechas.length; i++) {
                        fecha = new Date(fechas[i].fecha.date);
                        bDates[i] = { fecha: new Date(fecha) }

                        // populate the array
                        for (var d = new Date(fecha); d <= new Date(fecha); d.setDate(d.getDate() + 1)) {
                            dateRange.push($.datepicker.formatDate('dd/mm/yy', d));
                        }
                    }
                }


                $("#datepicker").datepicker({
                    dateFormat: 'dd/mm/yy',
                    minDate: 0, //restrict user to choose previous date
                });

                $("#datepicker").change(function () {
                    var fecha = $("#datepicker").datepicker("getDate");
                    var new_fecha_datepicker = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();

                    console.log(new_fecha_datepicker, "FECHA NORMALIZADA");

                    $.ajax({
                        url: 'http://127.0.0.1:8000/comprobar_cita/' + new_fecha_datepicker,
                        async: false,
                        success: function (data) {
                            fechas = JSON.parse(data)["fechas"];
                            var turno_vacios = [{ id: 1, puesto: 'primero' }, { id: 2, puesto: 'segundo' }, { id: 3, puesto: 'tercero' }, { id: 4, puesto: 'cuarto' }, { id: 5, puesto: 'quinto' }];
                            var indexOfObject;
                            if (fechas != undefined) {
                                for (let i = 0; i < fechas.length; i++) {
                                    if (fechas[i].turno < 5) {
                                        switch (fechas[i].turno) {
                                            case 1:
                                                indexOfObject = turno_vacios.findIndex(object => {
                                                    return object.id === 1;
                                                });
                                                turno_vacios.splice(indexOfObject, 1);
                                                break;
                                            case 2:
                                                indexOfObject = turno_vacios.findIndex(object => {
                                                    return object.id === 2;
                                                });
                                                turno_vacios.splice(indexOfObject, 1);
                                                break;
                                            case 3:
                                                indexOfObject = turno_vacios.findIndex(object => {
                                                    return object.id === 3;
                                                });
                                                turno_vacios.splice(indexOfObject, 1);
                                                break;
                                            case 4:
                                                indexOfObject = turno_vacios.findIndex(object => {
                                                    return object.id === 4;
                                                });
                                                turno_vacios.splice(indexOfObject, 1);
                                                break;
                                            case 5:
                                                indexOfObject = turno_vacios.findIndex(object => {
                                                    return object.id === 5;
                                                });
                                                turno_vacios.splice(indexOfObject, 1);
                                                break;
                                            default:
                                                indexOfObject = turno_vacios.findIndex(object => {
                                                    return object.id === 0;
                                                });
                                                turno_vacios.splice(indexOfObject, 1);
                                                break;
                                        }
                                    } else {

                                    }
                                }
                                var sel = $('<select>').appendTo($(".select_turno"));
                                $(turno_vacios).each(function () {
                                    sel.append($("<option>").attr('value', this.id).text(this.puesto));
                                    document.getElementById("pasa").disabled = false;

                                    var d = new Date();

                                    var month = d.getMonth() + 1;
                                    var day = d.getDate();

                                    var output = d.getFullYear() + '/' +
                                        (month < 10 ? '0' : '') + month + '/' +
                                        (day < 10 ? '0' : '') + day;

                                    $("#pasa").unbind().click(function () {
                                        var turno = $('select :selected').val();
                                        console.log(turno);
                                        jsonObject = {
                                            "fecha_cita": new_fecha_datepicker,
                                            "precio_cita": 55,
                                            "tipo_terapia_reserva_id": 779,
                                            "turno": turno,
                                        }
                                        console.log(jsonObject);
                                        $.ajax({
                                            method: "POST",
                                            url: "/reservar",
                                            dataType: "json",
                                            data: jsonObject
                                        }).done(function (data) {
                                            window.location.href = '/app_index';
                                        });



                                    });
                                });
                            }
                        }
                    })

                });
            }


        })
    })
})