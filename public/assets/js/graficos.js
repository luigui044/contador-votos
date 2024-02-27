am4core.ready(function() {

    // Themes begin
    // Themes end

    /**
     * Chart design taken from Samsung health app
     */
    grafico1();

}); // end am4core.ready()




// $(document).ready(function() {
//     setTimeout(recargar(t), 600000);

// });

// function recargar() {

//     location.reload()

// }

function grafico1() {

    //grafico de candidatos
    am4core.useTheme(am4themes_animated);
    am4core.useTheme(am4themes_dark);



    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
    chart.paddingRight = 40;
    chart.logo.disabled = true;



    var title = chart.titles.push(new am4core.Label());
    title.text = "CONTEO DE VOTOS";
    title.fontSize = 15;
    title.fill = am4core.color("#fff");


    chart.data = [{
            "name": "Candidato G",
            "steps": voto[0].mj,
            "href": "./assets/img/usuario.png",
            'color': am4core.color("#2b9348")
        }, {
            "name": "Candidato F",
            "steps": voto[0].mv,
            "href": "./assets/img/usuario.png",
            'color': am4core.color("#22577a")
        }, {
            "name": "Candidato E",
            "steps": voto[0].gf,
            "href": "./assets/img/usuario.png",
            'color': am4core.color("#f5cb5c")
        },
        {
            "name": "Candidato D",
            "steps": voto[0].lc,
            "href": "./assets/img/usuario.png",
            'color': am4core.color("#588b8b")
        },

        {
            "name": "Candidato C",
            "steps": voto[0].mm,
            "href": "./assets/img/usuario.png",
            'color': am4core.color("#0466c8")
        },
        {
            "name": "Candidato B",
            "steps": voto[0].ws,
            "href": "./assets/img/usuario.png",
            'color': am4core.color("#00b4d8")
        },

        {
            "name": "Candidato A",
            "steps": voto[0].mp,
            "href": "./assets/img/usuario.png",
            'color': am4core.color("#9b5de5")
        }

    ];

    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "name";
    categoryAxis.renderer.grid.template.strokeOpacity = 0;
    categoryAxis.renderer.minGridDistance = 5;
    categoryAxis.renderer.labels.template.dx = -26;
    categoryAxis.renderer.minWidth = 130;
    categoryAxis.renderer.tooltip.dx = -40;

    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.inside = true;
    valueAxis.renderer.labels.template.fillOpacity = 0.3;
    valueAxis.renderer.grid.template.strokeOpacity = 0;
    valueAxis.min = 0;
    valueAxis.cursorTooltipEnabled = false;
    valueAxis.renderer.baseGrid.strokeOpacity = 0;
    valueAxis.renderer.labels.template.dy = 30;

    var series = chart.series.push(new am4charts.ColumnSeries);
    series.dataFields.valueX = "steps";
    series.dataFields.categoryY = "name";
    series.tooltipText = "{valueX.value}";
    series.columns.template.propertyFields.fill = "color";

    series.tooltip.pointerOrientation = "vertical";
    series.tooltip.dy = -30;
    series.columnsContainer.zIndex = 100;

    var labelBullet = series.bullets.push(new am4charts.LabelBullet())
    labelBullet.label.horizontalCenter = "rigth";
    labelBullet.label.dx = 100;
    labelBullet.label.text = "{valueX}";
    labelBullet.locationX = 1;

    var columnTemplate = series.columns.template;
    columnTemplate.height = am4core.percent(50);
    columnTemplate.maxHeight = 50;
    columnTemplate.column.cornerRadius(60, 10, 60, 10);
    columnTemplate.strokeOpacity = 0;

    series.heatRules.push({ target: columnTemplate, property: "fill", dataField: "valueX", min: am4core.color("#e5dc36"), max: am4core.color("#5faa46") });
    series.mainContainer.mask = undefined;

    var cursor = new am4charts.XYCursor();
    chart.cursor = cursor;
    cursor.lineX.disabled = true;
    cursor.lineY.disabled = true;
    cursor.behavior = "none";

    var bullet = columnTemplate.createChild(am4charts.CircleBullet);
    bullet.circle.radius = 30;
    bullet.valign = "middle";
    bullet.align = "left";
    bullet.isMeasured = true;
    bullet.interactionsEnabled = false;
    bullet.horizontalCenter = "right";
    bullet.interactionsEnabled = false;

    var hoverState = bullet.states.create("hover");
    var outlineCircle = bullet.createChild(am4core.Circle);
    outlineCircle.adapter.add("radius", function(radius, target) {
        var circleBullet = target.parent;
        return circleBullet.circle.pixelRadius + 5;
    })

    var image = bullet.createChild(am4core.Image);
    image.width = 60;
    image.height = 60;
    image.horizontalCenter = "middle";
    image.verticalCenter = "middle";
    image.propertyFields.href = "href";

    image.adapter.add("mask", function(mask, target) {
        var circleBullet = target.parent;
        return circleBullet.circle;
    })

    var previousBullet;
    chart.cursor.events.on("cursorpositionchanged", function(event) {
        var dataItem = series.tooltipDataItem;

        if (dataItem.column) {
            var bullet = dataItem.column.children.getIndex(1);

            if (previousBullet && previousBullet != bullet) {
                previousBullet.isHover = false;
            }

            if (previousBullet != bullet) {

                var hs = bullet.states.getKey("hover");
                hs.properties.dx = dataItem.column.pixelWidth;
                bullet.isHover = true;

                previousBullet = bullet;
            }
        }
    })



    //////////////////////grafico de poddometro
    var chart = am4core.create("podometro2", am4charts.GaugeChart);
    chart.innerRadius = am4core.percent(82);
    chart.logo.disabled = true;

    var title = chart.titles.push(new am4core.Label());
    title.text = "PORCENTAJE JRV'S COMPLETADAS";
    title.fontSize = 15;
    title.fill = am4core.color("#fff");

    /**
     * Normal axis
     */

    var axis = chart.xAxes.push(new am4charts.ValueAxis());
    axis.min = 0;
    axis.max = 100;
    axis.strictMinMax = true;
    axis.renderer.radius = am4core.percent(80);
    axis.renderer.inside = true;
    axis.renderer.line.strokeOpacity = 1;
    axis.renderer.ticks.template.disabled = false
    axis.renderer.ticks.template.strokeOpacity = 1;
    axis.renderer.ticks.template.length = 10;
    axis.renderer.grid.template.disabled = true;
    axis.renderer.labels.template.radius = 40;
    // axis.renderer.labels.template.adapter.add("text", function(text) {
    //     return text + "%";
    // })

    /**
     * Axis for ranges
     */

    var colorSet = new am4core.ColorSet();

    var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
    axis2.min = 0;
    axis2.max = 100;
    axis2.strictMinMax = true;
    axis2.renderer.labels.template.disabled = true;
    axis2.renderer.ticks.template.disabled = true;
    axis2.renderer.grid.template.disabled = true;

    var range0 = axis2.axisRanges.create();
    range0.value = 0;
    range0.endValue = jrvsporc[0].total_jrv;
    range0.axisFill.fillOpacity = 1;
    range0.axisFill.fill = colorSet.getIndex(0);

    var range1 = axis2.axisRanges.create();
    range1.value = jrvsporc[0].total_jrv;
    range1.endValue = 100;
    range1.axisFill.fillOpacity = 1;
    range1.axisFill.fill = colorSet.getIndex(2);

    /**
     * Label
     */

    var label = chart.radarContainer.createChild(am4core.Label);
    label.isMeasured = false;
    label.fontSize = 30;
    label.x = am4core.percent(50);
    label.y = am4core.percent(100);
    label.horizontalCenter = "middle";
    label.verticalCenter = "bottom";
    label.text = jrvsporc[0].total_jrv + "%";


    /**
     * Hand
     */

    var hand = chart.hands.push(new am4charts.ClockHand());
    hand.axis = axis2;
    hand.innerRadius = am4core.percent(20);
    hand.startWidth = 5;
    hand.pin.disabled = true;
    hand.value = jrvsporc[0].total_jrv;

    hand.events.on("propertychanged", function(ev) {
        range0.endValue = ev.target.value;
        range1.value = ev.target.value;
        label.text = axis2.positionToValue(hand.currentPosition).toFixed(1);
        axis2.invalidate();
    });

    ////////////////////////////////////////////////////////////////////////////////////////////



    //////////////////////grafico de poddometro
    var chart2 = am4core.create("podometro", am4charts.GaugeChart);
    chart2.innerRadius = am4core.percent(82);
    chart2.logo.disabled = true;

    var title = chart2.titles.push(new am4core.Label());
    title.text = " JRV'S COMPLETADAS";
    title.fontSize = 15;
    title.fill = am4core.color("#fff");

    /**
     * Normal axis
     */

    var axis = chart2.xAxes.push(new am4charts.ValueAxis());
    axis.min = 0;
    axis.max = 328;
    axis.strictMinMax = true;
    axis.renderer.radius = am4core.percent(80);
    axis.renderer.inside = true;
    axis.renderer.line.strokeOpacity = 1;
    axis.renderer.ticks.template.disabled = false
    axis.renderer.ticks.template.strokeOpacity = 1;
    axis.renderer.ticks.template.length = 10;
    axis.renderer.grid.template.disabled = true;
    axis.renderer.labels.template.radius = 40;
    // axis.renderer.labels.template.adapter.add("text", function(text) {
    //     return text + "%";
    // })

    /**
     * Axis for ranges
     */

    var colorSet = new am4core.ColorSet();

    var axis2 = chart2.xAxes.push(new am4charts.ValueAxis());
    axis2.min = 0;
    axis2.max = 328;
    axis2.strictMinMax = true;
    axis2.renderer.labels.template.disabled = true;
    axis2.renderer.ticks.template.disabled = true;
    axis2.renderer.grid.template.disabled = true;

    var range0 = axis2.axisRanges.create();
    range0.value = 0;
    range0.endValue = 164;
    range0.axisFill.fillOpacity = 1;
    range0.axisFill.fill = colorSet.getIndex(0);

    var range1 = axis2.axisRanges.create();
    range1.value = 0;
    range1.endValue = 328;
    range1.axisFill.fillOpacity = 1;
    range1.axisFill.fill = colorSet.getIndex(2);

    /**
     * Label
     */

    var label = chart2.radarContainer.createChild(am4core.Label);
    label.isMeasured = false;
    label.fontSize = 30;
    label.x = am4core.percent(50);
    label.y = am4core.percent(100);
    label.horizontalCenter = "middle";
    label.verticalCenter = "bottom";
    label.text = "50%";


    /**
     * Hand
     */

    var hand = chart2.hands.push(new am4charts.ClockHand());
    hand.axis = axis2;
    hand.innerRadius = am4core.percent(20);
    hand.startWidth = 5;
    hand.pin.disabled = true;
    hand.value = jrvs[0].total_jrv;

    hand.events.on("propertychanged", function(ev) {
        range0.endValue = ev.target.value;
        range1.value = ev.target.value;
        label.text = axis2.positionToValue(hand.currentPosition).toFixed(1);
        axis2.invalidate();
    });

    /////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////grafico pastel
    var chart = am4core.create("pastel", am4charts.PieChart3D);
    chart.logo.disabled = true;
    var title = chart.titles.push(new am4core.Label());
    title.text = "PORCENTAJES DE VOTOS POR PARTIDO";
    title.fontSize = 15;
    title.fill = am4core.color("#fff");

    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
    chart.legend = new am4charts.Legend();


    chart.data = [{
            country: "PARTIDO A",
            litres: voto[0].mp
        },
        {
            country: "COALICIÓN A",
            litres: voto[0].ws
        },
        {
            country: "PARTIDO B",
            litres: voto[0].mm
        },
        {
            country: "PARTIDO C",
            litres: voto[0].mj
        },
        {
            country: "PARTIDO D",
            litres: voto[0].mv
        },
        {
            country: "PARTIDO E",
            litres: voto[0].lc
        },
        {
            country: "PARTIDO F",
            litres: voto[0].gf
        },

    ];

    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "litres";
    series.dataFields.category = "country";
    series.colors.list = [
        am4core.color("#9b5de5"),
        am4core.color("#00b4d8"),
        am4core.color("#0466c8"),
        am4core.color("#2b9348"),
        am4core.color("#22577a"),
        am4core.color("#588b8b"),
        am4core.color("#f5cb5c"),
    ];
    //////////////////////////////////////////////////////////////////////////





    // Create chart instance
    var chart = am4core.create("barra", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();
    chart.logo.disabled = true;

    // Add data
    chart.data = [{
        "country": "Validos",
        "visits": tvotos[0].validos
    }, {
        "country": "Nulos",
        "visits": tvotos[0].nulos
    }, {
        "country": "Impugnados",
        "visits": tvotos[0].impugnados
    }, {
        "country": "Abstencions",
        "visits": tvotos[0].abstenciones
    }];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 270;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;
    valueAxis.max = tvotos[0].validos * 1.1
        // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "visits";
    series.dataFields.categoryX = "country";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;

    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;


    var bullet = series.bullets.push(new am4charts.LabelBullet())
    bullet.interactionsEnabled = false
        // bullet.dy = 5;
    bullet.label.text = "{valueY.formatNumber('#.a')}";

    bullet.label.fontWeight = 'bold'

    bullet.label.fill = am4core.color('#fff')
        // bullet.label.truncate = true;
        // // bullet.label.hideOversized = true;

    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", function(fill, target) {
        return chart.colors.getIndex(target.dataItem.index);
    });

    // Cursor
    chart.cursor = new am4charts.XYCursor();




}