AmCharts.makeChart("chartdiv", {
    type: "stock",
    pathToImages: "amcharts/images/",
    dataDateFormat: "YYYY-MM-DD",
    dataSets: [{
        dataProvider: [{
            date: "2011-06-01",
            val: 10
        }, {
            date: "2011-06-02",
            val: 11
        }, {
            date: "2011-06-03",
            val: 12
        }, {
            date: "2011-06-04",
            val: 11
        }, {
            date: "2011-06-05",
            val: 10
        }, {
            date: "2011-06-06",
            val: 11
        }, {
            date: "2011-06-07",
            val: 13
        }, {
            date: "2011-06-08",
            val: 14
        }, {
            date: "2011-06-09",
            val: 17
        }, {
            date: "2011-06-10",
            val: 13
        }],
        fieldMappings: [{
            fromField: "val",
            toField: "value"
        }],
        categoryField: "date"
    }],

    panels: [{

        legend: {},

        stockGraphs: [{
            id: "graph1",
            valueField: "value",
            type: "column",
            title: "MyGraph",
            fillAlphas: 1
        }]
    }],

    panelsSettings: {
        startDuration: 1
    },

    categoryAxesSettings: {
        dashLength: 5
    },

    valueAxesSettings: {
        dashLength: 5
    },

    chartScrollbarSettings: {
        graph: "graph1",
        graphType: "line"
    },

    chartCursorSettings: {
        valueBalloonsEnabled: true
    },

    periodSelector: {
        periods: [{
            period: "DD",
            count: 1,
            label: "1 day"
        }, {
            period: "DD",
            selected: true,
            count: 5,
            label: "5 days"
        }, {
            period: "MM",
            count: 1,
            label: "1 month"
        }, {
            period: "YYYY",
            count: 1,
            label: "1 year"
        }, {
            period: "YTD",
            label: "YTD"
        }, {
            period: "MAX",
            label: "MAX"
        }]
    }
});
