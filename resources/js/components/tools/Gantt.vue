<template>
  <div ref="gantt"></div>
</template>
 
<script>
import {gantt} from 'dhtmlx-gantt';
export default {
  name: 'gantt',
  props: {
    tasks: {
      type: Object,
      default () {
        return {data: [], links: [], role: ''}
      }
    }
  },
 
  mounted: function () {
      
    gantt.config.xml_date = "%Y-%m-%d";
    var monthScaleTemplate = function (date) {
        var dateToStr = gantt.date.date_to_str("%M");
        var endDate = gantt.date.add(date, 1, "month");
        return dateToStr(date) + " - " + dateToStr(endDate);
    };
    console.log(this.tasks.role);
    if(this.tasks.role == 3)
    {
      gantt.config.readonly = false; 
    }else{
      gantt.config.readonly = true;   
    }
    
    gantt.config.scales = [
        {unit: "year", step: 1, format: "%Y"},
        {unit: "month", step: 1, format: monthScaleTemplate},
        {unit: "month", step: 1, format: "%M"}
    ];

    gantt.init(this.$refs.gantt);
    
    gantt.createDataProcessor((entity, action, data, id) => {
      this.$emit(`${entity}-updated`, id, action, data);
    });
    
    gantt.attachEvent('onTaskSelected', (id) => {
      let task = gantt.getTask(id);
      this.$emit('task-selected', task);
    });
 
    gantt.attachEvent('onTaskIdChange', (id, new_id) => {
       if (gantt.getSelectedId() == new_id) {
         let task = gantt.getTask(new_id);
         this.$emit('task-selected', task);
        }
    });

      gantt.load('api/v1/data');
      var dp = gantt.dataProcessor("/api/v1/gantt");
      dp.init(gantt);
      dp.setTransactionMode("REST");
  }
}
</script>
 
<style>
    @import "~dhtmlx-gantt/codebase/dhtmlxgantt.css";
</style>