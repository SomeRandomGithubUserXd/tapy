<script setup>

import {getCurrentInstance, onMounted, ref} from "vue";
import 'cropperjs/dist/cropper.css';
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, PointElement, LineElement} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, PointElement, LineElement)

console.log(JSON.stringify(props.page.chart))

const chartData = {
    labels: ['January', 'February', 'March'],
    datasets: [
        {
            label: 'Visitors',
            backgroundColor: '#8B5DCF',
            data: [1, 2, 3]
        },
        {
            label: 'Views',
            backgroundColor: '#E5408A',
            data: [1, 1, 4]
        },
    ]
}
const chartOptions = {
    responsive: true,
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        stacked: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    userCallback: function(label, index, labels) {
                        if (Math.floor(label) === label) {
                            return label;
                        }

                    },
                }
            }],
        },
    },
}

const props = defineProps({
    page: Object,
    modelValue: Boolean,
})

const self = getCurrentInstance()

const emit = defineEmits(['update:modelValue'])

const dataSource = ref([]);

const columns = [
    {
        title: self.parent.ctx.translate('Link'),
        dataIndex: 'link',
        key: 'link',
    },
    {
        title: self.parent.ctx.translate('Clicks'),
        dataIndex: 'clicks',
        key: 'clicks',
    }
];

const compileLinkClicks = () => {
    let i = 0
    const newArr = []
    for (const key in props.page.link_clicks_grouped)
    {
        newArr.push({
            key: i,
            link: key,
            clicks: props.page.link_clicks_grouped[key]
        })
        i++
    }
    dataSource.value = newArr
}

compileLinkClicks()


const dataSource1 = ref([]);

const compileVisits = () => {
    let i = 0
    const newArr = []
    for (const key in props.page.visits_grouped)
    {
        newArr.push({
            key: i,
            from: key,
            visits: props.page.visits_grouped[key]
        })
        i++
    }
    dataSource1.value = newArr
}

compileVisits()

const columns1 = [
    {
        title: self.parent.ctx.translate('Source'),
        dataIndex: 'from',
        key: 'from',
    },
    {
        title: self.parent.ctx.translate('Visits'),
        dataIndex: 'visits',
        key: 'visits',
    }
];
</script>

<template>
    <a-modal
        class="animate__animated tabs-modal"
        :class="modelValue ? 'animate__zoomIn' : 'animate__zoomOut'"
        :visible="modelValue"
        @change="emit('update:modelValue', false)"
        :footer="false">
        <template #title>
            <div>{{ $root.translate('Page analytics') }}</div>
        </template>
        <div class="py-5 d-flex flex-column">
            <Line
                ref="chart"
                :chart-options="chartOptions"
                :chart-data="props.page.chart"
                :chart-id="1"
                :dataset-id-key="1"
                :width="200"
                :height="200"
            />
            <div class="mt-5">
                <span class="ant-typography ant-typography-secondary">{{ $root.translate('Link clicks') }}</span>
                <a-table :dataSource="dataSource" :columns="columns" :pagination="false"/>
            </div>
            <div class="mt-5">
                <span class="ant-typography ant-typography-secondary">{{ $root.translate('Traffic Sources') }}</span>
                <a-table :dataSource="dataSource1" :columns="columns1" :pagination="false"/>
            </div>
        </div>
    </a-modal>
</template>
