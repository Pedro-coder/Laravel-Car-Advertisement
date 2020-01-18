<template>
  <div>
    <div class="container-fluid mt-5 mb-3">
      <div class="col-md-10 offset-md-1">
        <div class="card shadow-lg">
          <div class="card-header">
            <a href="/home">
              <i class="fa fa-times-circle fl-r crs-pntr" style="font-size:27px;color:#6c757d;"></i>
            </a>
            <h5 class="card-title pt-3">Category Setup</h5>
          </div>
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-4 pr-5">
                <div class="list-group">
                  <br>
                  <cnc-vue-jstree
                    :data="data.data"
                    multiple
                    allow-batch
                    whole-row
                    draggable
                    data-is-flat
                    text-field-name="title"
                    id-field-name="id"
                    order-field-name="order"
                    parent-field-name="parent"
                    @item-drop="itemDrop"
                    @item-click="itemClick"
                  ></cnc-vue-jstree>
                </div>
              </div>
              <div class="form-group col-md-8">
                <br>
                <br>

                <div v-for="parent in categorySetup">
                  <div class="form-group row">
                    <label for="category_search" class="col-sm-4 col-form-label">Parent Category</label>
                    <div class="col-sm-1 text-center image-upload">
                      <label for="file-input">
                        <i class="fa fa-image" type="file"></i>
                      </label>
                      
                      <input
                        id="file-input"
                        type="file"
                        @change="onSelectedParentIcon($event,parent.id)"
                      >
                      <img :src="selectedParentIcon">
                    </div>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <input
                          v-model="parent.name"
                          class="form-control"
                          type="search"
                          placeholder="Parent"
                        >
                      </div>
                    </div>
                  </div>
                  <div class="form-group row" v-for="child in parent.children">
                    <label for="category_search" class="col-sm-4 col-form-label">Category Name</label>
                    <div class="col-sm-1 text-center image-upload">
                      <label for="file-input">
                        <i class="fa fa-image" type="file"></i>
                      </label>
                      <input
                        id="file-input2"
                        type="file"
                        @change="onSelectedChildIcon($event, child.id)"
                      >
                      <img :src="selectedChildIcon">
                    </div>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <div class="input-group-append">
                          <!-- <input type="file" width="48" height="48"> -->
                        </div>
                        <input
                          v-model="child.name"
                          class="form-control"
                          type="search"
                          placeholder="Child"
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <br>

                <div class="form-group row">
                  <div class="col-md-4">
                    <button @click="cUpdate()" class="btn btn-success btn-block">Save</button>
                  </div>
                  <div class="col-md-4">
                    <button @click="cDelete()" class="btn btn-danger btn-block">Delete</button>
                  </div>
                  <div class="col-md-2">
                    <button @click="reset()" class="btn btn-danger btn-block">Reset</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      data: {
        data: [
          {
            id: "1",
            parent: "",
            order: "A",
            title: "Smiles",
            icon: "far fa-smile text-warning",
            opened: true
          },
          {
            id: "2",
            parent: "1",
            order: "B",
            icon: "far fa-smile text-warning",
            title: "smile"
          },
          {
            id: "3",
            parent: "1",
            order: "B",
            icon: "far fa-frown text-warning",
            title: "sad"
          },
          {
            id: "4",
            parent: "1",
            order: "B",
            icon: "fa fa-angry text-warning",
            title: "angry",
            opened: true
          },

          {
            id: "8",

            order: "A",
            title: "Vehicles",
            opened: true
          },
          {
            id: "9",
            parent: "8",
            order: "B",
            title: "Parts",
            icon: "fas fa-cogs",
            opened: true
          },
          {
            id: "10",
            parent: "9",
            order: "C",
            icon: "fal fa-steering-wheel text-warning",
            title: "Wheel"
          },
          {
            id: "11",
            parent: "8",
            order: "B",
            title: "Whole",
            opened: true
          },
          {
            id: "12",
            parent: "11",
            order: "B",
            icon: "fas fa-truck text-warning",
            title: "Truck"
          },
          {
            id: "13",
            parent: "11",
            order: "B",
            icon: "fas fa-car-alt text-warning",
            title: "Car"
          }
        ]
      },

      categorySetup: [
        {
          name: "",
          image: "",
          id: "",
          parent: "",
          children: [
            {
              name: "",
              image: "",
              id: "",
              parent: "",
              children: []
            }
          ]
        }
      ],
      categoryEmpty: {
        name: "",
        image: "",
        id: "",
        parent: "",
        children: [
          {
            name: "",
            image: "",
            id: "",
            parent: "",
            children: []
          }
        ]
      },
      childrenEmpty: {
        name: "",
        image: "",
        id: "",
        parent: "",
        children: []
      },
      selectedParentIcon: null,
      selectedChildIcon: null,
      isAdd: true,
      serverData: {
        category: ""
      }
    };
  },
  created() {
    // console.log(this.recurse(this.data));
    // this.fetchData();
  },
  methods: {
    itemClick(node) {
      console.log(node.model.id + " clicked !");
    },
    itemDrop(source, destination, changeObj) {
      console.log("dropped", source.title, destination.title, changeObj);
    },
    fetchData() {
      axios.get(`api/category`).then(response => {
        this.data = JSON.parse(response.data.category);
        console.log(this.data);
      });
    },
    reset() {
      this.isAdd = true;
      this.categorySetup = [this.categoryEmpty];
    },
    isDisable() {
      // return true;
    },
    onSelectedParentIcon(event, id) {
      this.selectedParentIcon = event.target.files[0];
      console.log(event);
    },
    onSelectedChildIcon(event, id) {
      this.selectedChildIcon = event.target.files[0];
      console.log(event);
    },
    allowDrag(model, component) {
      // if (model.name === "Car") {
      //   model.name = "asdasd";
      //   // return false;
      // }
      // model.name = '<img src="' + model.image + '" />' + model.name;
      // can be dragged
      return true;
    },

    allowDrop(model, component) {
      // if (model.name === "Node 2-2") {
      //   // can't be placed
      //   return false;
      // }
      // // can be placed
      return true;
    },
    curNodeClicked(model, component) {
      // console.log("curNodeClicked", model, component);
      this.isAdd = false;
      if (model.children.length !== 0) {
        this.categorySetup.pop(this.categorySetup);
        this.categorySetup.push(model);
      }
      if (model.children.length === 0) {
        this.categorySetup.pop(this.categoryEmpty);
        this.categorySetup.push(model);
        this.categorySetup[0].children.push(this.childrenEmpty);
      }
      console.log("curNodeClicked", this.categorySetup);
    },
    cUpdate() {
      if (!this.isAdd) {
        if (this.categorySetup[0].children.name === "") {
          this.categorySetup.children.pop(this.childrenEmpty);
          this.categorySetup = [this.categoryEmpty];
        }
        if (this.categorySetup[0].children.name !== "") {
          this.categorySetup = [this.categoryEmpty];
        }
      }
      if (this.isAdd) {
        let uniqid = require("uniqid");
        let pIcon = this.selectedParentIcon;
        let cIcon = this.selectedChildIcon;
        this.categorySetup.forEach(function(parent, pindex) {
          parent.children.forEach(function(child, cindex) {
            parent.id = uniqid();
            child.id = uniqid();
            parent.image = pIcon;
            child.image = cIcon;
          });
        });
        if (this.categorySetup[0].name !== "") {
          this.data.push(this.categorySetup[0]);
          // this.serverData.category = JSON.stringify(this.data);
          this.serverData.category = JSON.stringify(this.data);
          // console.log(this.serverData);
          fetch(`api/category/1`, {
            method: "put",
            body: JSON.stringify(this.serverData),
            headers: {
              "content-type": "application/json"
            }
          })
            .then(res => console.log(res))
            .then(data => {
              // this.supplys.supply.supply_color.name = "";
              // this.successMessage = "Size edited";
              // this.dismissCountDown = this.dismissSecs;
              // this.fetchData();
            })
            .catch(err => console.log(err));
          this.categorySetup = [this.categoryEmpty];
        }
      }
      // console.log(pIcon);
    },
    cDelete() {
      let n = this.categorySetup;
      let pr0Index = "";
      let pr1Index = "";
      let pr2Index = "";
      let pr3Index = "";
      let pr4Index = "";
      let pr5Index = "";
      let isParent0Delete = false;
      let isParent1Delete = false;
      let isParent2Delete = false;
      let isParent3Delete = false;
      let isParent4Delete = false;
      let isParent5Delete = false;
      this.data.forEach(function(parent0, p0index) {
        // if (parent.children.length !== 0) {

        if (parent0.name === n[0].name) {
          isParent0Delete = true;
          pr0Index = p0index;
        } else {
          parent0.children.forEach(function(parent1, p1index) {
            if (parent1.name === n[0].name) {
              isParent0Delete = false;
              isParent1Delete = true;
              pr0Index = p0index;
              pr1Index = p1index;
            } else {
              parent1.children.forEach(function(parent2, p2index) {
                if (parent2.name === n[0].name) {
                  isParent1Delete = false;
                  isParent2Delete = true;
                  pr0Index = p0index;
                  pr1Index = p1index;
                  pr2Index = p2index;
                } else {
                  parent2.children.forEach(function(parent3, p3index) {
                    if (parent3.name === n[0].name) {
                      isParent2Delete = false;
                      isParent3Delete = true;
                      pr0Index = p0index;
                      pr1Index = p1index;
                      pr2Index = p2index;
                      pr3Index = p3index;
                    } else {
                      parent3.children.forEach(function(parent4, p4index) {
                        if (parent4.name === n[0].name) {
                          isParent3Delete = false;
                          isParent4Delete = true;
                          pr0Index = p0index;
                          pr1Index = p1index;
                          pr2Index = p2index;
                          pr3Index = p3index;
                          pr4Index = p4index;
                        } else {
                          parent4.children.forEach(function(parent5, p5index) {
                            if (parent5.name === n[0].name) {
                              isParent4Delete = false;
                              pr0Index = p0index;
                              pr1Index = p1index;
                              pr2Index = p2index;
                              pr3Index = p3index;
                              pr4Index = p4index;
                              pr5Index = p5index;
                            }
                          });
                        }
                      });
                    }
                  });
                }
              });
            }
          });
        }
        // }
      });
      if (isParent0Delete) {
        this.data.splice(pr0Index, 1);
      } else if (isParent1Delete) {
        this.data[pr0Index].children.splice(pr1Index, 1);
      } else if (isParent2Delete) {
        this.data[pr0Index].children[pr1Index].children.splice(pr2Index, 1);
      } else if (isParent3Delete) {
        this.data[pr0Index].children[pr1Index].children[
          pr2Index
        ].children.splice(pr3Index, 1);
      } else if (isParent4Delete) {
        this.data[pr0Index].children[pr1Index].children[pr2Index].children[
          pr3Index
        ].children.splice(pr4Index, 1);
      } else {
        this.data[pr0Index].children[pr1Index].children[pr2Index].children[
          pr3Index
        ].children[pr4Index].children.splice(pr4Index, 1);
      }

      // }if(n[0].children.length === 0){

      // }

      // console.log(n);
    },
    dragHandler(model, component, e) {
      console.log("dragHandler: ", model, component, e);
    },
    dragEnterHandler(model, component, e) {
      // console.log('dragEnterHandler: ', model, component, e);
    },
    dragLeaveHandler(model, component, e) {
      console.log("dragLeaveHandler: ", model, component, e);
    },
    dragOverHandler(model, component, e) {
      console.log("dragOverHandler: ", model, component, e);
    },
    dragEndHandler(model, component, e) {
      // console.log('dragEndHandler: ', model, component, e);
    },
    dropHandler(model, component, e) {
      // console.log('dropHandler: ', model, component, e);
    }

    // recurse(node) {
    //   for (var i = 0, count = node.children.length; i < count; i++) {
    //     recurse(node.children[i]);
    //   }
    // }
  }
};
</script>
<style>
.image-upload > input {
  display: none;
}
</style>
