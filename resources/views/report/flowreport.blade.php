@extends('dashboard.app')
@section('title', 'Flow Report')
@section('content')
    <section class="content-header">
        <h1>Flow Report</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Report</li>
            <li class="active">Flow Report</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box-header">
                    <h1 class="box-title">Last Update : {{$lu}}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box-header">
                    <div id="sample">
                        <span style="display: inline-block; vertical-align: top; width:90%">
                            <div id="myDiagramDiv" style=" height: 720px"></div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            function init() {
                if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
                var $ = go.GraphObject.make;  //for conciseness in defining node templates

                myDiagram =
                    $(go.Diagram, "myDiagramDiv",  //Diagram refers to its DIV HTML element by id
                        { initialContentAlignment: go.Spot.Center, "undoManager.isEnabled": true });

                // when the document is modified, add a "*" to the title and enable the "Save" button
                myDiagram.addDiagramListener("Modified", function(e) {
                    var button = document.getElementById("SaveButton");
                    if (button) button.disabled = !myDiagram.isModified;
                    var idx = document.title.indexOf("*");
                    if (myDiagram.isModified) {
                        if (idx < 0) document.title += "*";
                    } else {
                        if (idx >= 0) document.title = document.title.substr(0, idx);
                    }
                });

                myDiagram.isReadOnly = true;

                // To simplify this code we define a function for creating a context menu button:
                function makeButton(text, action, visiblePredicate) {
                    return $("ContextMenuButton",
                        $(go.TextBlock, text),
                        { click: action },
                        // don't bother with binding GraphObject.visible if there's no predicate
                        visiblePredicate ? new go.Binding("visible", "", function(o, e) { return o.diagram ? visiblePredicate(o, e) : false; }).ofObject() : {});
                }

                var nodeMenu =  // context menu for each Node
                    $(go.Adornment, "Vertical",
                        makeButton("Copy",
                            function(e, obj) { e.diagram.commandHandler.copySelection(); }),
                        makeButton("Delete",
                            function(e, obj) { e.diagram.commandHandler.deleteSelection(); }),
                        $(go.Shape, "LineH", { strokeWidth: 2, height: 1, stretch: go.GraphObject.Horizontal }),
                        makeButton("Add top port",
                            function (e, obj) { addPort("top"); }),
                        makeButton("Add left port",
                            function (e, obj) { addPort("left"); }),
                        makeButton("Add right port",
                            function (e, obj) { addPort("right"); }),
                        makeButton("Add bottom port",
                            function (e, obj) { addPort("bottom"); })
                    );

                var portSize = new go.Size(8, 8);

                var portMenu =  // context menu for each port
                    $(go.Adornment, "Vertical",
                        makeButton("Remove port",
                            // in the click event handler, the obj.part is the Adornment;
                            // its adornedObject is the port
                            function (e, obj) { removePort(obj.part.adornedObject); }),
                        makeButton("Change color",
                            function (e, obj) { changeColor(obj.part.adornedObject); }),
                        makeButton("Remove side ports",
                            function (e, obj) { removeAll(obj.part.adornedObject); })
                    );

                // the node template
                // includes a panel on each side with an itemArray of panels containing ports
                myDiagram.nodeTemplate =
                    $(go.Node, "Table",
                        { locationObjectName: "BODY",
                            locationSpot: go.Spot.Center,
                            selectionObjectName: "BODY",
                            contextMenu: nodeMenu
                        },
                        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),

                        // the body
                        $(go.Panel, "Auto",
                            { row: 1, column: 1, name: "BODY",
                                stretch: go.GraphObject.Fill },
                            $(go.Shape, "Rectangle",
                                { fill: "#AC193D", stroke: null, strokeWidth: 0,
                                    minSize: new go.Size(56, 56) },
                                new go.Binding("fill","color"),
                                new go.Binding("width").makeTwoWay(),
                                new go.Binding("height").makeTwoWay()
                            ),
                            $(go.TextBlock,
                                { margin: 10, textAlign: "center", font: "10px  Segoe UI,sans-serif", stroke: "white", editable: true },
                                new go.Binding("text", "name").makeTwoWay())
                        ),  // end Auto Panel body



                        // the Panel holding the left port elements, which are themselves Panels,
                        // created for each item in the itemArray, bound to data.leftArray
                        $(go.Panel, "Vertical",
                            new go.Binding("itemArray", "leftArray"),
                            { row: 1, column: 0,
                                itemTemplate:
                                    $(go.Panel,
                                        { _side: "left",  // internal property to make it easier to tell which side it's on
                                            fromSpot: go.Spot.Left, toSpot: go.Spot.Left,
                                            fromLinkable: true, toLinkable: true, cursor: "pointer",
                                            contextMenu: portMenu },
                                        new go.Binding("portId", "portId"),
                                        $(go.Shape, "Rectangle",
                                            { stroke: null, strokeWidth: 0,
                                                desiredSize: portSize,
                                                margin: new go.Margin(1,0) },
                                            new go.Binding("fill", "portColor"))
                                    )  // end itemTemplate
                            }
                        ),  // end Vertical Panel

                        // the Panel holding the top port elements, which are themselves Panels,
                        // created for each item in the itemArray, bound to data.topArray
                        $(go.Panel, "Horizontal",
                            new go.Binding("itemArray", "topArray"),
                            { row: 0, column: 1,
                                itemTemplate:
                                    $(go.Panel,
                                        { _side: "top",
                                            fromSpot: go.Spot.Top, toSpot: go.Spot.Top,
                                            fromLinkable: true, toLinkable: true, cursor: "pointer",
                                            contextMenu: portMenu },
                                        new go.Binding("portId", "portId"),
                                        $(go.Shape, "Rectangle",
                                            { stroke: null, strokeWidth: 0,
                                                desiredSize: portSize,
                                                margin: new go.Margin(0, 1) },
                                            new go.Binding("fill", "portColor"))
                                    )  // end itemTemplate
                            }
                        ),  // end Horizontal Panel

                        // the Panel holding the right port elements, which are themselves Panels,
                        // created for each item in the itemArray, bound to data.rightArray
                        $(go.Panel, "Vertical",
                            new go.Binding("itemArray", "rightArray"),
                            { row: 1, column: 2,
                                itemTemplate:
                                    $(go.Panel,
                                        { _side: "right",
                                            fromSpot: go.Spot.Right, toSpot: go.Spot.Right,
                                            fromLinkable: true, toLinkable: true, cursor: "pointer",
                                            contextMenu: portMenu },
                                        new go.Binding("portId", "portId"),
                                        $(go.Shape, "Rectangle",
                                            { stroke: null, strokeWidth: 0,
                                                desiredSize: portSize,
                                                margin: new go.Margin(1, 0) },
                                            new go.Binding("fill", "portColor"))
                                    )  // end itemTemplate
                            }
                        ),  // end Vertical Panel

                        // the Panel holding the bottom port elements, which are themselves Panels,
                        // created for each item in the itemArray, bound to data.bottomArray
                        $(go.Panel, "Horizontal",
                            new go.Binding("itemArray", "bottomArray"),
                            { row: 2, column: 1,
                                itemTemplate:
                                    $(go.Panel,
                                        { _side: "bottom",
                                            fromSpot: go.Spot.Bottom, toSpot: go.Spot.Bottom,
                                            fromLinkable: true, toLinkable: true, cursor: "pointer",
                                            contextMenu: portMenu },
                                        new go.Binding("portId", "portId"),
                                        $(go.Shape, "Rectangle",
                                            { stroke: null, strokeWidth: 0,
                                                desiredSize: portSize,
                                                margin: new go.Margin(0, 1) },
                                            new go.Binding("fill", "portColor"))
                                    )  // end itemTemplate
                            }
                        )  // end Horizontal Panel
                    );  // end Node

                // an orthogonal link template, reshapable and relinkable
                myDiagram.linkTemplate =
                    $(CustomLink,  // defined below
                        {
                            routing: go.Link.AvoidsNodes,
                            corner: 4,
                            curve: go.Link.JumpGap,
                            reshapable: true,
                            resegmentable: true,
                            relinkableFrom: true,
                            relinkableTo: true
                        },
                        new go.Binding("points").makeTwoWay(),
                        $(go.Shape, { stroke: "#2F4F4F", strokeWidth: 2 })
                    );

                // support double-clicking in the background to add a copy of this data as a node
                myDiagram.toolManager.clickCreatingTool.archetypeNodeData = {
                    name: "Unit",
                    leftArray: [],
                    rightArray: [],
                    topArray: [],
                    bottomArray: []
                };

                myDiagram.contextMenu =
                    $(go.Adornment, "Vertical",
                        makeButton("Paste",
                            function(e, obj) { e.diagram.commandHandler.pasteSelection(e.diagram.lastInput.documentPoint); },
                            function(o) { return o.diagram.commandHandler.canPasteSelection(); }),
                        makeButton("Undo",
                            function(e, obj) { e.diagram.commandHandler.undo(); },
                            function(o) { return o.diagram.commandHandler.canUndo(); }),
                        makeButton("Redo",
                            function(e, obj) { e.diagram.commandHandler.redo(); },
                            function(o) { return o.diagram.commandHandler.canRedo(); })
                    );

                myDiagram.linkTemplate =
                    $(go.Link,
                        {
                            routing: go.Link.Orthogonal, corner: 5,
                            relinkableFrom: true, relinkableTo: true
                        },
                        $(go.Shape, { stroke: "gray", strokeWidth: 2 }),
                        $(go.Shape, { stroke: "gray", fill: "gray", toArrow: "Standard" }),
                        $(go.TextBlock, // this is a Link label
                            new go.Binding("text", "text"),{segmentOffset: new go.Point(8, 5)})
                    );

                // load the diagram from JSON data
                load();
            }


            // This custom-routing Link class tries to separate parallel links from each other.
            // This assumes that ports are lined up in a row/column on a side of the node.
            function CustomLink() {
                go.Link.call(this);
            };
            go.Diagram.inherit(CustomLink, go.Link);

            CustomLink.prototype.findSidePortIndexAndCount = function(node, port) {
                var nodedata = node.data;
                if (nodedata !== null) {
                    var portdata = port.data;
                    var side = port._side;
                    var arr = nodedata[side + "Array"];
                    var len = arr.length;
                    for (var i = 0; i < len; i++) {
                        if (arr[i] === portdata) return [i, len];
                    }
                }
                return [-1, len];
            };

            /** @override */
            CustomLink.prototype.computeEndSegmentLength = function(node, port, spot, from) {
                var esl = go.Link.prototype.computeEndSegmentLength.call(this, node, port, spot, from);
                var other = this.getOtherPort(port);
                if (port !== null && other !== null) {
                    var thispt = port.getDocumentPoint(this.computeSpot(from));
                    var otherpt = other.getDocumentPoint(this.computeSpot(!from));
                    if (Math.abs(thispt.x - otherpt.x) > 20 || Math.abs(thispt.y - otherpt.y) > 20) {
                        var info = this.findSidePortIndexAndCount(node, port);
                        var idx = info[0];
                        var count = info[1];
                        if (port._side == "top" || port._side == "bottom") {
                            if (otherpt.x < thispt.x) {
                                return esl + 4 + idx * 8;
                            } else {
                                return esl + (count - idx - 1) * 8;
                            }
                        } else {  // left or right
                            if (otherpt.y < thispt.y) {
                                return esl + 4 + idx * 8;
                            } else {
                                return esl + (count - idx - 1) * 8;
                            }
                        }
                    }
                }
                return esl;
            };

            /** @override */
            CustomLink.prototype.hasCurviness = function() {
                if (isNaN(this.curviness)) return true;
                return go.Link.prototype.hasCurviness.call(this);
            };

            /** @override */
            CustomLink.prototype.computeCurviness = function() {
                if (isNaN(this.curviness)) {
                    var fromnode = this.fromNode;
                    var fromport = this.fromPort;
                    var fromspot = this.computeSpot(true);
                    var frompt = fromport.getDocumentPoint(fromspot);
                    var tonode = this.toNode;
                    var toport = this.toPort;
                    var tospot = this.computeSpot(false);
                    var topt = toport.getDocumentPoint(tospot);
                    if (Math.abs(frompt.x - topt.x) > 20 || Math.abs(frompt.y - topt.y) > 20) {
                        if ((fromspot.equals(go.Spot.Left) || fromspot.equals(go.Spot.Right)) &&
                            (tospot.equals(go.Spot.Left) || tospot.equals(go.Spot.Right))) {
                            var fromseglen = this.computeEndSegmentLength(fromnode, fromport, fromspot, true);
                            var toseglen = this.computeEndSegmentLength(tonode, toport, tospot, false);
                            var c = (fromseglen - toseglen) / 2;
                            if (frompt.x + fromseglen >= topt.x - toseglen) {
                                if (frompt.y < topt.y) return c;
                                if (frompt.y > topt.y) return -c;
                            }
                        } else if ((fromspot.equals(go.Spot.Top) || fromspot.equals(go.Spot.Bottom)) &&
                            (tospot.equals(go.Spot.Top) || tospot.equals(go.Spot.Bottom))) {
                            var fromseglen = this.computeEndSegmentLength(fromnode, fromport, fromspot, true);
                            var toseglen = this.computeEndSegmentLength(tonode, toport, tospot, false);
                            var c = (fromseglen - toseglen) / 2;
                            if (frompt.x + fromseglen >= topt.x - toseglen) {
                                if (frompt.y < topt.y) return c;
                                if (frompt.y > topt.y) return -c;
                            }
                        }
                    }
                }
                return go.Link.prototype.computeCurviness.call(this);
            };
            // end CustomLink class


            // Add a port to the specified side of the selected nodes.
            function addPort(side) {
                myDiagram.startTransaction("addPort");
                myDiagram.selection.each(function(node) {
                    // skip any selected Links
                    if (!(node instanceof go.Node)) return;
                    // compute the next available index number for the side
                    var i = 0;
                    while (node.findPort(side + i.toString()) !== node) i++;
                    // now this new port name is unique within the whole Node because of the side prefix
                    var name = side + i.toString();
                    // get the Array of port data to be modified
                    var arr = node.data[side + "Array"];
                    if (arr) {
                        // create a new port data object
                        var newportdata = {
                            portId: name,
                            portColor: go.Brush.randomColor()
                            // if you add port data properties here, you should copy them in copyPortData above
                        };
                        // and add it to the Array of port data
                        myDiagram.model.insertArrayItem(arr, -1, newportdata);
                    }
                });
                myDiagram.commitTransaction("addPort");
            }

            // Remove the clicked port from the node.
            // Links to the port will be redrawn to the node's shape.
            function removePort(port) {
                myDiagram.startTransaction("removePort");
                var pid = port.portId;
                var arr = port.panel.itemArray;
                for (var i = 0; i < arr.length; i++) {
                    if (arr[i].portId === pid) {
                        myDiagram.model.removeArrayItem(arr, i);
                        break;
                    }
                }
                myDiagram.commitTransaction("removePort");
            }

            // Remove all ports from the same side of the node as the clicked port.
            function removeAll(port) {
                myDiagram.startTransaction("removePorts");
                var nodedata = port.part.data;
                var side = port._side;  // there are four property names, all ending in "Array"
                myDiagram.model.setDataProperty(nodedata, side + "Array", []);  // an empty Array
                myDiagram.commitTransaction("removePorts");
            }

            // Change the color of the clicked port.
            function changeColor(port) {
                myDiagram.startTransaction("colorPort");
                var data = port.data;
                myDiagram.model.setDataProperty(data, "portColor", go.Brush.randomColor());
                myDiagram.commitTransaction("colorPort");
            }


            // Save the model to / load it from JSON text shown on the page itself, not in a database.
            function save() {
                document.getElementById("mySavedModel").value = myDiagram.model.toJson();
                myDiagram.isModified = false;
            }

            function load() {
                myDiagram.model = myDiagram.model = go.Model.fromJson(
                    { "class": "go.GraphLinksModel",
                        "copiesArrays": true,
                        "copiesArrayObjects": true,
                        "linkFromPortIdProperty": "fromPort",
                        "linkToPortIdProperty": "toPort",
                        "nodeDataArray": [
                            {"name":"1.Pending : [0]", "leftArray":[ {"portId":"left0", "portColor":"#000"} ], "rightArray":[], "topArray":[], "bottomArray":[], "key":-3, "loc":"200 0", "color": "#203864", "width":"10", "height":"5"},
                            {"name":"2.Submitted : [1]", "leftArray":[ {"portId":"left0", "portColor":"#000"} ], "rightArray":[], "topArray":[], "bottomArray":[ {"portId":"bottom0", "portColor":"#000"} ], "key":-4, "loc":"200 60", "color": "#203864", "width":"10", "height":"5"},
                            {"name":"1.Pending : [0]", "leftArray":[], "rightArray":[], "topArray":[], "bottomArray":[], "key":-5, "loc":"310 0", "color": "#2F5596", "width":"10", "height":"5"},
                            {"name":"2.Submitted : [1]", "leftArray":[], "rightArray":[], "topArray":[], "bottomArray":[ {"portId":"bottom0", "portColor":"#000"} ], "key":-6, "loc":"310 60", "color": "#2F5596", "width":"10", "height":"5"},
                            {"name":"3.Inprogress : [1]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-7, "loc":"200 310", "color": "#203864", "width":"10", "height":"17"},
                            {"name":"17.Complete : [1]", "leftArray":[], "rightArray":[], "topArray":[], "bottomArray":[], "key":-8, "loc":"200 440", "color": "#203864", "width":"10", "height":"5"},
                            {"name":"X.Pending Cancel", "leftArray":[ {"portId":"left0", "portColor":"#000"} ], "rightArray":[], "topArray":[], "bottomArray":[], "key":-9, "loc":"200 500", "color": "#203864", "width":"10", "height":"5"},
                            {"name":"17.Complete : [1]", "leftArray":[], "rightArray":[ {"portId":"right0", "portColor":"#000"} ], "topArray":[], "bottomArray":[], "key":-10, "loc":"310 440", "color": "#2F5596", "width":"10", "height":"5"},
                            {"name":"X.Pending Cancel", "leftArray":[], "rightArray":[], "topArray":[], "bottomArray":[], "key":-11, "loc":"310 500", "color": "#2F5596", "width":"10", "height":"5"},
                            {"name":"3.Inprogress : [2]", "leftArray":[], "rightArray":[], "topArray":[], "bottomArray":[], "key":-12, "loc":"310 250", "color": "#2F5596", "width":"10", "height":"5"},
                            {"name":"11.Pending BASO : [2]", "leftArray":[], "rightArray":[ {"portId":"right0", "portColor":"#000"} ], "topArray":[], "bottomArray":[], "key":-13, "loc":"310 310", "color": "#2F5596", "width":"10", "height":"5"},
                            {"name":"13.Pending Billing\nApproval : [2]", "leftArray":[], "rightArray":[ {"portId":"right0", "portColor":"#000"} ], "topArray":[], "bottomArray":[], "key":-14, "loc":"310 370", "color": "#2F5596", "width":"10", "height":"5"},
                            {"name":"AIA\nCOM", "leftArray":[ {"portId":"left0", "portColor":"#000"},{"portId":"left1", "portColor":"#000"},{"portId":"left2", "portColor":"#000"},{"portId":"left3", "portColor":"#000"},{"portId":"left4", "portColor":"#000"},{"portId":"left5", "portColor":"#000"} ], "rightArray":[ {"portId":"right0", "portColor":"#000"},{"portId":"right1", "portColor":"#000"},{"portId":"right2", "portColor":"#000"},{"portId":"right3", "portColor":"#000"},{"portId":"right4", "portColor":"#000"},{"portId":"right5", "portColor":"#000"} ], "topArray":[ {"portId":"top0", "portColor":"#000"},{"portId":"top1", "portColor":"#000"},{"portId":"top2", "portColor":"#000"},{"portId":"top3", "portColor":"#000"},{"portId":"top4", "portColor":"#000"},{"portId":"top5", "portColor":"#000"} ], "bottomArray":[ {"portId":"bottom0", "portColor":"#000"},{"portId":"bottom1", "portColor":"#000"},{"portId":"bottom2", "portColor":"#000"},{"portId":"bottom3", "portColor":"#000"},{"portId":"bottom4", "portColor":"#000"},{"portId":"bottom5", "portColor":"#000"} ], "key":-15, "loc":"460 157", "color": "green", "width":"10", "height":"10"},
                            {"name":"X.Failed", "leftArray":[ {"portId":"left0", "portColor":"#000"} ], "rightArray":[], "topArray":[], "bottomArray":[], "key":-16, "loc":"255 560", "color": "#000", "width":"20", "height":"5"},
                            {"name":"TSQ\n[2]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-17, "loc":"460 500", "color": "red", "width":"5", "height":"5"},
                            {"name":"Deliver\n[2]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-18, "loc":"520 500", "color": "red", "width":"5", "height":"5"},
                            {"name":"TREMS", "leftArray":[ {"portId":"left0", "portColor":"#000"} ], "rightArray":[], "topArray":[], "bottomArray":[], "key":-20, "loc":"450 -60 ", "color": "#ED7D31", "width":"10", "height":"5"},
                            {"name":"TIBS", "leftArray":[], "rightArray":[ {"portId":"right0", "portColor":"#000"} ], "topArray":[], "bottomArray":[ {"portId":"bottom0", "portColor":"#000"},{"portId":"bottom1", "portColor":"#000"} ], "key":-21, "loc":"450 0 ", "color": "#ED7D31", "width":"10", "height":"5"},
                            {"name":"3.SCS : [0]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-22, "loc":"550 250", "color": "#B3C7E8", "width":"5", "height":"5"},
                            {"name":"5.SCC : [0]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-23, "loc":"610 250", "color": "#B3C7E8", "width":"5", "height":"5"},
                            {"name":"8.PS : [2]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-24, "loc":"670 250", "color": "#B3C7E8", "width":"5", "height":"5"},
                            {"name":"10.PC : [2]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-25, "loc":"730 250", "color": "#B3C7E8", "width":"5", "height":"5"},
                            {"name":"12.BAS : [2]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[ {"portId":"bottom0", "portColor":"#000"} ], "key":-27, "loc":"850 260", "color": "#B3C7E8", "width":"5", "height":"8"},
                            {"name":"15.FBS : [2]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-28, "loc":"910 260", "color": "#B3C7E8", "width":"5", "height":"8"},
                            {"name":"17.FBC : [2]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[], "key":-29, "loc":"970 260", "color": "#B3C7E8", "width":"5", "height":"8"},
                            {"name":"11.BS : [2]", "leftArray":[], "rightArray":[], "topArray":[ {"portId":"top0", "portColor":"#000"} ], "bottomArray":[ {"portId":"bottom0", "portColor":"#000"} ], "key":-30, "loc":"790 250", "color": "#B3C7E8", "width":"5", "height":"5"}
                        ],
                        "linkDataArray": [
                            {"from":-3, "to":-4, "fromPort":"left0", "toPort":"left0", "points":[161.29644687500004,-52.437872812499876,151.29644687500004,-52.437872812499876,151.29644687500004,16.767127187500193,161.73642734375002,16.767127187500193,172.1764078125,16.767127187500193,186.1764078125,16.767127187500193]},
                            {"from":-6, "to":-15, "fromPort":"bottom0", "toPort":"left0", "points":[360.3814078125,58.5761408593751,360.3814078125,68.5761408593751,360.3814078125,77.62036148697885,469.7483154787101,77.62036148697885,579.1152231449202,77.62036148697885,593.1152231449202,77.62036148697885],"text":"2"},
                            {"from":-4, "to":-15, "fromPort":"bottom0", "toPort":"left1", "points":[222.1764078125,52.76712718750019,222.1764078125,62.76712718750019,222.1764078125,87.62036148697885,396.64581547871006,87.62036148697885,571.1152231449202,87.62036148697885,593.1152231449202,87.62036148697885],"text":"2"},
                            {"from":-15, "to":-16, "fromPort":"left2", "toPort":"left0", "points":[593.1152231449202,97.62036148697885,559.1152231449202,97.62036148697885,119.97046687500006,97.62036148697885,119.97046687500006,606.3750000000002,139.34318359375,606.3750000000002,153.34318359375,606.3750000000002]},
                            {"from":-15, "to":-9, "fromPort":"left3", "toPort":"left0", "points":[593.1152231449202,107.62036148697885,567.1152231449202,107.62036148697885,137.41536864440107,107.62036148697885,137.41536864440107,321.68902618337614,137.41536864440107,535.7576908797735,151.41536864440107,535.7576908797735]},
                            {"from":-15, "to":-7, "fromPort":"left4", "toPort":"top0", "points":[593.1152231449202,117.62036148697885,575.1152231449202,117.62036148697885,224.27898192565104,117.62036148697885,224.27898192565104,150.25532989431366,224.27898192565104,182.89029830164844,224.27898192565104,192.89029830164844],"text":"3"},
                            {"from":-15, "to":-13, "fromPort":"left5", "toPort":"right0", "points":[593.1152231449202,127.62036148697885,583.1152231449202,127.62036148697885,527.4971745580938,127.62036148697885,527.4971745580938,336.5990483122387,475.8791259712674,336.5990483122387,461.8791259712674,336.5990483122387],"text":"11"},
                            {"from":-15, "to":-14, "fromPort":"bottom0", "toPort":"right0", "points":[606.1152231449202,140.62036148697885,606.1152231449202,154.62036148697885,606.1152231449202,408.5990483122387,530.9986394018438,408.5990483122387,455.8820556587674,408.5990483122387,441.8820556587674,408.5990483122387],"text":"13"},
                            {"from":-15, "to":-10, "fromPort":"bottom1", "toPort":"right0", "points":[616.1152231449202,140.62036148697885,616.1152231449202,162.62036148697885,616.1152231449202,472.75769087977346,532.6839970665355,472.75769087977346,449.25277098815104,472.75769087977346,435.25277098815104,472.75769087977346],"text":"17"},
                            {"from":-15, "to":-17, "fromPort":"bottom2", "toPort":"top0", "points":[626.1152231449202,140.62036148697885,626.1152231449202,174.62036148697885,626.1152231449202,343.52001277473954,626.6542471875001,343.52001277473954,626.6542471875001,492.41966406250026,626.6542471875001,506.41966406250026],"text":"5"},
                            {"from":-15, "to":-18, "fromPort":"bottom3", "toPort":"top0", "points":[636.1152231449202,140.62036148697885,636.1152231449202,166.62036148697885,636.1152231449202,340.34858359505205,698.1260146875003,340.34858359505205,698.1260146875003,482.0768057031253,698.1260146875003,496.0768057031253],"text":"6"},
                            {"from":-20, "to":-15, "fromPort":"left0", "toPort":"top0", "points":[589.8069079687502,-121.24674843750012,579.8069079687502,-121.24674843750012,579.8069079687502,-1.3131934752606327,606.1152231449202,-1.3131934752606327,606.1152231449202,50.62036148697885,606.1152231449202,64.62036148697885],"text":"3"},
                            {"from":-15, "to":-21, "fromPort":"top1", "toPort":"bottom0", "points":[616.1152231449202,64.62036148697885,616.1152231449202,22.62036148697885,616.1152231449202,-1.301028162760609,625.4830918750004,-1.301028162760609,625.4830918750004,2.777582187499931,625.4830918750004,-11.222417812500069],"text":"3"},
                            {"from":-15, "to":-21, "fromPort":"top2", "toPort":"bottom1", "points":[626.1152231449202,64.62036148697885,626.1152231449202,30.62036148697885,626.1152231449202,14.698971837239391,635.4830918750004,14.698971837239391,635.4830918750004,10.777582187499931,635.4830918750004,-11.222417812500069],"text":"15"},
                            {"from":-21, "to":-15, "fromPort":"right0", "toPort":"top3", "points":[666.4830918750004,-47.22241781250007,676.4830918750004,-47.22241781250007,676.4830918750004,33.69897183723939,636.1152231449202,33.69897183723939,636.1152231449202,38.62036148697885,636.1152231449202,64.62036148697885]},
                            {"from":-15, "to":-29, "fromPort":"top4", "toPort":"top0", "points":[646.1152231449202,64.62036148697885,646.1152231449202,46.62036148697885,1481.5184462594839,46.62036148697885,1481.5184462594839,97.5951865661145,1481.5184462594839,148.57001164525016,1481.5184462594839,162.57001164525016],"text":"15"},
                            {"from":-15, "to":-28, "fromPort":"top5", "toPort":"top0", "points":[656.1152231449202,64.62036148697885,656.1152231449202,54.62036148697885,1366.7201582770733,54.62036148697885,1366.7201582770733,101.5951865661145,1366.7201582770733,148.57001164525016,1366.7201582770733,162.57001164525016],"text":"17"},
                            {"from":-15, "to":-27, "fromPort":"right0", "toPort":"top0", "points":[669.1152231449202,77.62036148697885,719.1152231449202,77.62036148697885,1251.921870294663,77.62036148697885,1251.921870294663,111.54385835013599,1251.921870294663,145.46735521329313,1251.921870294663,159.46735521329313],"text":"13"},
                            {"from":-15, "to":-30, "fromPort":"right1", "toPort":"top0", "points":[669.1152231449202,87.62036148697885,711.1152231449202,87.62036148697885,1146.431551608124,87.62036148697885,1146.431551608124,115.76819424214673,1146.431551608124,143.91602699731462,1146.431551608124,157.91602699731462],"text":"11"},
                            {"from":-15, "to":-25, "fromPort":"right2", "toPort":"top0", "points":[669.1152231449202,97.62036148697885,703.1152231449202,97.62036148697885,1035.0643471875007,97.62036148697885,1035.0643471875007,119.53129793098947,1035.0643471875007,141.44223437500008,1035.0643471875007,155.44223437500008],"text":"10"},
                            {"from":-15, "to":-24, "fromPort":"right3", "toPort":"top0", "points":[669.1152231449202,107.62036148697885,695.1152231449202,107.62036148697885,938.0669484375006,107.62036148697885,938.0669484375006,123.8931571497395,938.0669484375006,140.16595281250014,938.0669484375006,154.16595281250014],"text":"8"},
                            {"from":-15, "to":-23, "fromPort":"right4", "toPort":"top0", "points":[669.1152231449202,117.62036148697885,687.1152231449202,117.62036148697885,838.5169865625005,117.62036148697885,838.5169865625005,128.8931571497395,838.5169865625005,140.16595281250014,838.5169865625005,154.16595281250014],"text":"4"},
                            {"from":-15, "to":-22, "fromPort":"right5", "toPort":"top0", "points":[669.1152231449202,127.62036148697885,679.1152231449202,127.62036148697885,736.4144615625005,127.62036148697885,736.4144615625005,132.61687558723946,736.4144615625005,137.61338968750007,736.4144615625005,151.61338968750007],"text":"3"},
                            {"from":-30, "to":-15, "fromPort":"bottom0", "toPort":"bottom5", "points":[1146.431551608124,229.91602699731462,1146.431551608124,243.91602699731462,656.1152231449202,243.91602699731462,656.1152231449202,197.26819424214673,656.1152231449202,150.62036148697885,656.1152231449202,140.62036148697885],"text":"12. BASO Approved"},
                            {"from":-27, "to":-15, "fromPort":"bottom0", "toPort":"bottom4", "points":[1251.921870294663,231.46735521329313,1251.921870294663,245.46735521329313,1251.921870294663,262.17446850036936,646.1152231449202,262.17446850036936,646.1152231449202,158.62036148697885,646.1152231449202,140.62036148697885],"text":"14. Billing Approved"}
                        ]
                    }
                );
            }
            init();
        });
    </script>
@endsection