$(function () {
    document.getElementById("pasa").disabled = true;
    var fechas = [];
    var dateRange = [];
    var bDates = [];
    let jsonObject = {};
    var nombre_servicio;
    var new_fecha_datepicker;
    var turno_vacios = [];
    $.ajax({
        method: "GET",
        url: "http://127.0.0.1:8000/get_terapias",
        dataType: "json",
        data: jsonObject
    }).done(function (data) {
        for (let i = 0; i < data.terapias_a.length; i++) {
            $(".terapia").append($("<option class='option_terapia'>").attr('value', data.terapias_a[i].id).text(data.terapias_a[i].nombre_terapia));
        }
        $('.terapia').removeAttr('disabled');

        $(".terapia").change(function () {
            $('.servicio').attr('disabled', 'disabled');
            $('.option_servicio').remove();
            $('.turno').attr('disabled', 'disabled');
            $('.turno').empty().append('<option value="por_defecto">Elija su turno</option>');
            $('#datepicker').datepicker('destroy');
            $('#datepicker').attr('disabled', 'disabled');
            turno_vacios = [];
            var turno = $('.terapia :selected').val();
            $(".wlly").remove();
            $.ajax({
                method: "GET",
                url: "http://127.0.0.1:8000/get_servicios/" + turno,
                dataType: "json",
                data: jsonObject
            }).done(function (data) {
                //console.log(data);
                for (let i = 0; i < data.servicios_a.length; i++) {
                    $(".servicio").append($("<option class='option_servicio'>").attr('value', data.servicios_a[i].id_servicio).text(data.servicios_a[i].nombre_servicio));
                }
                $('.servicio').removeAttr('disabled');
                //console.log(data.servicios_a[0].nombre_servicio);

            });
        })
    })


    $(".servicio").change(function () {
        $('#datepicker').datepicker('destroy');
        $('#datepicker').removeAttr('disabled');
        $('#datepicker').datepicker('setDate', null);
        $('.turno').attr('disabled', 'disabled');
        $('.turno').empty().append('<option value="por_defecto">Elija su turno</option>');
        $.ajax({
            url: 'http://127.0.0.1:8000/reservar_cita',
            async: false,
            success: function (data) {
                fechas = JSON.parse(data)["fechas"];
                //console.log(fechas);
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
                    $('.turno').empty().append('<option value="por_defecto">Elija su turno</option>');
                    var fecha = $("#datepicker").datepicker("getDate");
                    var new_fecha_datepicker = fecha.getFullYear() + '-' + (fecha.getMonth() + 1) + '-' + fecha.getDate();

                    //console.log(new_fecha_datepicker, "FECHA NORMALIZADA");

                    $.ajax({
                        url: 'http://127.0.0.1:8000/comprobar_cita/' + new_fecha_datepicker,
                        async: false,
                        success: function (data) {
                            fechas = JSON.parse(data)["fechas"];
                            turno_vacios = [{ id: 1, puesto: 'primero' }, { id: 2, puesto: 'segundo' }, { id: 3, puesto: 'tercero' }, { id: 4, puesto: 'cuarto' }, { id: 5, puesto: 'quinto' }];
                            var indexOfObject;
                            if (fechas != undefined) {
                                for (let i = 0; i < fechas.length; i++) {
                                    if (fechas[i].turno <= 5) {
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
                                console.log(turno_vacios);
                                $(turno_vacios).each(function () {
                                    $(".turno").append($("<option class='option_turno'>").attr('value', this.id).text(this.puesto));
                                    $('.turno').removeAttr('disabled');
                                    document.getElementById("pasa").disabled = false;

                                    var d = new Date();

                                    var month = d.getMonth() + 1;
                                    var day = d.getDate();

                                    var output = d.getFullYear() + '/' +
                                        (month < 10 ? '0' : '') + month + '/' +
                                        (day < 10 ? '0' : '') + day;

                                    $("#pasa").unbind().click(function () {
                                        nombre_servicio = $('.servicio :selected').val();
                                        turno = $('.turno :selected').val();
                                        jsonObject = {
                                            "fecha_cita": new_fecha_datepicker,
                                            "precio_cita": 55,
                                            "servicio_escogido": nombre_servicio,
                                            "turno": turno,
                                        }
                                        console.log(jsonObject);
                                        $.ajax({
                                            method: "POST",
                                            url: "/reservar",
                                            dataType: "json",
                                            data: jsonObject
                                        }).done(function (data) {
                                            window.location.href = 'http://127.0.0.1:8000/';
                                        });
                                    });
                                });
                            } else {
                                $(turno_vacios).each(function () {
                                    $(".turno").append($("<option class='option_turno'>").attr('value', this.id).text(this.puesto));
                                    $('.turno').removeAttr('disabled');
                                })
                            }

                        }
                    })

                });
            }


        })
    })
})