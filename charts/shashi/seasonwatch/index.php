<!doctype html>
<html>
    <head>
        <title>SeasonWatch.in visualizations</title>
        <link rel="stylesheet" href="style.css" type="text/javascript">
        <script src="jquery.min.js"></script>
        <script src="underscore-min.js"></script>
        <style>

        body {
          font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
          margin: auto;
          position: relative;
          width: 960px;
        }

        text {
          font: 10px sans-serif;
        }

        .axis path,
        .axis line {
          fill: none;
          stroke: #000;
          shape-rendering: crispEdges;
        }

        form {
          position: absolute;
          right: 10px;
          top: 10px;
        }

        </style>
    </head>
    <body>
    <form>
      <label><input type="radio" name="mode" value="grouped"> Grouped</label>
      <label><input type="radio" name="mode" value="stacked" checked> Stacked</label>
    </form>
    <script src="d3.v3.min.js"></script>
    <script>
WEEKS = 53;
MONTHS = 12;
METRIC = "avg";
YEAR = 2012;
function draw(data) {

    console.log(data);
    console.log(d3.map(data, function (layer) { return bumpLayer(layer, METRIC); }));
    // data contains metrics to compare.
    var n = 2, // number of layers
        m = 53, // number of samples per layer
        stack = d3.layout.stack(),
        layers = stack(data.map(function (layer) { return bumpLayer(layer, METRIC); })),
        yGroupMax = d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y; }); }),
        yStackMax = d3.max(layers, function(layer) { return d3.max(layer, function(d) { return d.y0 + d.y; }); });
    console.log(yGroupMax);
    console.log(yStackMax);

    var margin = {top: 40, right: 10, bottom: 20, left: 10},
        width = 960 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    var x = d3.scale.ordinal()
        .domain(d3.range(m))
        .rangeRoundBands([0, width], .08);

    var y = d3.scale.linear()
        .domain([0, yStackMax])
        .range([height, 0]);

    var color = d3.scale.linear()
        .domain([0, n - 1])
        .range(["#aad", "#556"]);

    var xAxis = d3.svg.axis()
        .scale(x)
        .tickSize(0)
        .tickPadding(6)
        .orient("bottom");

    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
      .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var layer = svg.selectAll(".layer")
        .data(layers)
      .enter().append("g")
        .attr("class", "layer")
        .style("fill", function(d, i) { return color(i); });

    var rect = layer.selectAll("rect")
        .data(function(d) { return d; })
      .enter().append("rect")
        .attr("x", function(d) { return x(d.x); })
        .attr("y", height)
        .attr("width", x.rangeBand())
        .attr("height", 0);

    rect.transition()
        .delay(function(d, i) { return i * 10; })
        .attr("y", function(d) { return y(d.y0 + d.y); })
        .attr("height", function(d) { return y(d.y0) - y(d.y0 + d.y); });

    svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);

    d3.selectAll("input").on("change", change);

    var timeout = setTimeout(function() {
      d3.select("input[value=\"grouped\"]").property("checked", true).each(change);
    }, 2000);

    function change() {
      clearTimeout(timeout);
      if (this.value === "grouped") transitionGrouped();
      else transitionStacked();
    }

    function transitionGrouped() {
      y.domain([0, yGroupMax]);

      rect.transition()
          .duration(500)
          .delay(function(d, i) { return i * 10; })
          .attr("x", function(d, i, j) { return x(d.x) + x.rangeBand() / n * j; })
          .attr("width", x.rangeBand() / n)
        .transition()
          .attr("y", function(d) { return y(d.y); })
          .attr("height", function(d) { return height - y(d.y); });
    }

    function transitionStacked() {
      y.domain([0, yStackMax]);

      rect.transition()
          .duration(500)
          .delay(function(d, i) { return i * 10; })
          .attr("y", function(d) { return y(d.y0 + d.y); })
          .attr("height", function(d) { return y(d.y0) - y(d.y0 + d.y); })
        .transition()
          .attr("x", function(d) { return x(d.x); })
          .attr("width", x.rangeBand());
    }
}

    // Inspired by Lee Byron's test data generator.
    function bumpLayer(layer, metric, grouping) {
        if (grouping === undefined) grouping = "week";

        var FIELDS = ['year', grouping, 'count', 'avg', 'sdev'];

        function get(row, field) {
            var idx = FIELDS.indexOf(field);
            if (idx >=0 ) {
                try {
                    return row[idx];
                } catch (e) {
                    return 0;
                }
            } else {
                return 0;
            }
        }

        function checkField(field, value) {
            var idx = FIELDS.indexOf(field);
            if (idx >= 0) {
                return function (item) {
                    return item[idx] == value;
                }
            } else {
                return null;
            }
        }

        layer = _.filter(layer, checkField("year", YEAR));
        var data = [];
        for (i=0; i < WEEKS; ++i) {
                data[i] = {x: i, y: 0};
           var item = _.find(layer, checkField(grouping, i));
           if (!item) {
               data[i] = {x: i, y: 0};
           } else {
               data[i] = {x: i, y: get(item, metric)};
           }
        }
        return data;
    }

    $.ajax({
        url: "data/matureleaf_count_weekly.json",
        type: "GET",
        responseType: "json",
        success: function (data) {
            $.ajax({
                url: "data/flower_bee_weekly.json",
                type: "GET",
                responseType: "json",
                success: function (data2) {
                    draw([data, data2]);
                }
            });
        }
    });


    </script>

    </body>
</html>