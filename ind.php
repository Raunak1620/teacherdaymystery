<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wheel of Fortune Bingo</title>

<!--

MIT License
Copyright (c) 2017 Jeremy Rue
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

    <style type="text/css">
    text{
        font-family: "Comic Sans MS",cursive,sans-serif;
        font-size:11px;
        font-style: bold;
        pointer-events:none;
    }
    #chart{
        position:absolute;
        width:500px;
        height:500px;
        top:90px;
        left:100px;
    }
    #question{
        position: absolute;
        width:400px;
        height:500px;
        top:110px;
        left:640px;
    }
    #question h1{
        font-size: 55px;
        font-weight: bold;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        position: absolute;
        padding: 0;
        margin: 0;
        color: #fc766aff;
        top:50%;
        -webkit-transform:translate(0,-50%);
                transform:translate(0,-50%);
    }
    h2{
      color: #fc766aff;
      margin-top: 29px;
      text-align: center;
      font-size: 35px;
      font-family: "Comic Sans MS",cursive,sans-serif;

    }
    body{
      background-image: url("img2.PNG");
      height: 645px;
      border: 4px solid #fc766aff;
     }
    </style>

</head>
<body>
  <h2>UnFoLd tHe QuEsTiONnAiRe ?MysTery?</h2>
    <div id="chart"></div>
    <div id="question"><h1></h1></div>
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        var padding = {top:20, right:40, bottom:0, left:0},
            w = 500 - padding.left - padding.right,
            h = 500 - padding.top  - padding.bottom,
            r = Math.min(w, h)/2,
            rotation = 0,
            oldrotation = 0,
            picked = 100000,
            oldpick = [],
            color = d3.scale.category20();//category20c()
            //randomNumbers = getRandomNumbers();

        //http://osric.com/bingo-card-generator/?title=HTML+and+CSS+BINGO!&words=padding%2Cfont-family%2Ccolor%2Cfont-weight%2Cfont-size%2Cbackground-color%2Cnesting%2Cbottom%2Csans-serif%2Cperiod%2Cpound+sign%2C%EF%B9%A4body%EF%B9%A5%2C%EF%B9%A4ul%EF%B9%A5%2C%EF%B9%A4h1%EF%B9%A5%2Cmargin%2C%3C++%3E%2C{+}%2C%EF%B9%A4p%EF%B9%A5%2C%EF%B9%A4!DOCTYPE+html%EF%B9%A5%2C%EF%B9%A4head%EF%B9%A5%2Ccolon%2C%EF%B9%A4style%EF%B9%A5%2C.html%2CHTML%2CCSS%2CJavaScript%2Cborder&freespace=true&freespaceValue=Web+Design+Master&freespaceRandom=false&width=5&height=5&number=35#results

        var data = [
                    {"label":"Prof.Kunal",  "value":1,  "question":"Person who inspired you the most and why?"}, // padding
                    {"label":"Prof.Nutan",  "value":1,  "question":"Who is your first love?"}, //font-family
                    {"label":"Prof.Sweta",  "value":1,  "question":"Crack a joke and make us laugh"}, //color
                    {"label":"Prof.Rekha",  "value":1,  "question":"What inspired you to become a teacher?"}, //font-weight
                    {"label":"Prof.Vinita",  "value":1,  "question":"If you could break any one rule of amity,what it would be?"}, //font-size
                    {"label":"Prof.Arko",  "value":1,  "question":"What is the biggest secret that you kept from your parents when you were growing up?"}, //background-color
                    {"label":"Prof.Srikant",  "value":1,  "question":"Which is your favourite movie that you secretly know is actualy terrible?"}, //nesting
                    {"label":"Prof.Chetna",  "value":1,  "question":"What is your worst habit?"}, //bottom
                    {"label":"Prof.Aprajita",  "value":1,  "question":"What is something you most look forward to doing when you retire?"}, //sans-serif
                    {"label":"Prof.Keya", "value":1, "question":"Do you have a bucketlist?If so, What is one thing on that list?"}, //period
                    {"label":"Prof.Kamini", "value":1, "question":"Tell us about the last dream you can remember.Don't leave any details out!"}, //pound sign
                    {"label":"Prof.Ritu Bala", "value":1, "question":"If there is any of your student that inspired you? Mention him or her and tell us why?"}, //<body>
                    {"label":"Prof.Sanjay", "value":1, "question":"Have you ever lied about being sick so you could stay home from work?"}, //<ul>
                    {"label":"Prof.Tripta", "value":1, "question":"What is the one thing you really like about yourself?"}, //<h1>
                    {"label":"Prof.Santosh", "value":1, "question":"What is the most embarassing thing that has happened to you in front of crowd?"}, //margin
                    {"label":"Prof.Sidhartha", "value":1, "question":"What was your favourite childhood television show?"}, //< >
        ];


        var svg = d3.select('#chart')
            .append("svg")
            .data([data])
            .attr("width",  w + padding.left + padding.right)
            .attr("height", h + padding.top + padding.bottom);

        var container = svg.append("g")
            .attr("class", "chartholder")
            .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");

        var vis = container
            .append("g");

        var pie = d3.layout.pie().sort(null).value(function(d){return 1;});

        // declare an arc generator function
        var arc = d3.svg.arc().outerRadius(r);

        // select paths, use arc generator to draw
        var arcs = vis.selectAll("g.slice")
            .data(pie)
            .enter()
            .append("g")
            .attr("class", "slice");


        arcs.append("path")
            .attr("fill", function(d, i){ return color(i); })
            .attr("d", function (d) { return arc(d); });

        // add the text
        arcs.append("text").attr("transform", function(d){
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle)/2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
            })
            .attr("text-anchor", "end")
            .text( function(d, i) {
                return data[i].label;
            });

        container.on("click", spin);


        function spin(d){

            container.on("click", null);

            //all slices have been seen, all done
            console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
            if(oldpick.length == data.length){
                console.log("done");
                container.on("click", null);
                return;
            }

            var  ps       = 360/data.length,
                 pieslice = Math.round(1440/data.length),
                 rng      = Math.floor((Math.random() * 1440) + 360);

            rotation = (Math.round(rng / ps) * ps);

            picked = Math.round(data.length - (rotation % 360)/ps);
            picked = picked >= data.length ? (picked % data.length) : picked;


            if(oldpick.indexOf(picked) !== -1){
                d3.select(this).call(spin);
                return;
            } else {
                oldpick.push(picked);
            }

            rotation += 90 - Math.round(ps/2);

            vis.transition()
                .duration(4000)
                .attrTween("transform", rotTween)
                .each("end", function(){

                    //mark question as seen
                    d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                        .attr("fill", "white");

                    //populate question
                    d3.select("#question h1")
                        .text(data[picked].question);

                    oldrotation = rotation;

                    container.on("click", spin);
                });
        }

        //make arrow
        svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
            .style({"fill":"white"});

        //draw spin circle
        container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 60)
            .style({"fill":"#031321","cursor":"pointer"});

        //spin text
        container.append("text")
            .attr("x", 0)
            .attr("y", 10)
            .attr("text-anchor", "middle")
            .text("SPIN")
            .style({"font-weight":"bold","fill":"#fc766aff", "font-size":"30px", "font-family":"Comic Sans MS,cursive,sans-serif"});


        function rotTween(to) {
          var i = d3.interpolate(oldrotation % 360, rotation);
          return function(t) {
            return "rotate(" + i(t) + ")";
          };
        }


        function getRandomNumbers(){
            var array = new Uint16Array(1000);
            var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);

            if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){
                window.crypto.getRandomValues(array);
                console.log("works");
            } else {
                //no support for crypto, get crappy random numbers
                for(var i=0; i < 1000; i++){
                    array[i] = Math.floor(Math.random() * 100000) + 1;
                }
            }

            return array;
        }

    </script>
</body>
</html>
