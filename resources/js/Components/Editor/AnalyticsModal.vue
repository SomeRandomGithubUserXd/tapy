<script setup>

import {getCurrentInstance, onMounted, ref, watch} from "vue";
import 'cropperjs/dist/cropper.css';
import {Line} from 'vue-chartjs'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement
} from 'chart.js'
import {Inertia} from "@inertiajs/inertia";

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, PointElement, LineElement)

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
                    userCallback: function (label, index, labels) {
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
    chart_stuff: Object,
    visits: Object,
    link_clicks: Object,
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
    for (const key in props.link_clicks) {
        newArr.push({
            key: i,
            link: key,
            clicks: props.link_clicks[key]
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
    for (const key in props.visits) {
        newArr.push({
            key: i,
            from: self.parent.ctx.translate(key),
            visits: props.visits[key]
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

const period = ref(Number((new URL(window.location)).searchParams.get('period')));

watch(period, value => {
    const url = new URL(window.location);
    url.searchParams.set('period', value);
    window.history.pushState({}, '', url);
    Inertia.reload()
})

watch(() => props.visits, () => {
    compileVisits()
})

watch(() => props.link_clicks, () => {
    compileLinkClicks()
})
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
        <div class="d-flex flex-column pb-4">
            <div style="display: flex; justify-content: center; margin-bottom: 20px;margin-top: 20px">
                <div class="ant-radio-group ant-radio-group-outline ant-radio-group-small">
                    <label
                        @click="period = 0"
                        class="ant-radio-button-wrapper"
                        :class="period === 0 ? 'ant-radio-button-wrapper-checked' : ''">
                    <span class="ant-radio-button" :class="period === 0 ? 'ant-radio-button-checked' : ''">
                        <span class="ant-radio-button-inner">

                        </span>
                    </span>
                        <span>
                        {{ $root.translate('Today') }}
                        </span>
                    </label>
                    <label
                        @click="period = 1"
                        class="ant-radio-button-wrapper"
                        :class="$page.props.auth.user.is_pro ? period === 1 ? 'ant-radio-button-wrapper-checked' : '' : 'ant-radio-button-wrapper-disabled'">
                    <span class="ant-radio-button" :class="$page.props.auth.user.is_pro ? period === 1 ? 'ant-radio-button-checked' : '' : 'ant-radio-button-disabled'">
                        <span class="ant-radio-button-inner">
                        </span>
                    </span>
                        <span class="d-flex">
                            {{ $root.translate('Week') }}
                            <div v-if="!$page.props.auth.user.is_pro" class="ant-space-item ms-2"><span class="ant-tag ant-tag-has-color m-0" style="background-color: rgb(0, 0, 0);">PRO</span></div>
                        </span>
                    </label>
                    <label
                        @click="period = 2"
                        class="ant-radio-button-wrapper"
                        :class="$page.props.auth.user.is_pro ? period === 2 ? 'ant-radio-button-wrapper-checked' : '' : 'ant-radio-button-wrapper-disabled'">
                    <span class="ant-radio-button" :class="$page.props.auth.user.is_pro ? period === 2 ? 'ant-radio-button-checked' : '' : 'ant-radio-button-disabled'">
                        <span class="ant-radio-button-inner">
                        </span>
                    </span>
                        <span class="d-flex">
                            {{ $root.translate('Month') }}
                            <div v-if="!$page.props.auth.user.is_pro" class="ant-space-item ms-2"><span class="ant-tag ant-tag-has-color m-0" style="background-color: rgb(0, 0, 0);">PRO</span></div>
                        </span>
                    </label>
                    <label
                        @click="period = 3"
                        class="ant-radio-button-wrapper"
                        :class="$page.props.auth.user.is_pro ? period === 3 ? 'ant-radio-button-wrapper-checked' : '' : 'ant-radio-button-wrapper-disabled'">
                    <span class="ant-radio-button" :class="$page.props.auth.user.is_pro ? period === 3 ? 'ant-radio-button-checked' : '' : 'ant-radio-button-disabled'">
                            <span class="ant-radio-button-inner"></span>
                        </span>
                        <span class="d-flex">
                            {{ $root.translate('Year') }}
                            <div v-if="!$page.props.auth.user.is_pro" class="ant-space-item ms-2"><span class="ant-tag ant-tag-has-color m-0" style="background-color: rgb(0, 0, 0);">PRO</span></div>
                        </span>
                    </label>
                </div>
            </div>
            <Line
                ref="chart"
                :chart-options="chartOptions"
                :chart-data="chart_stuff"
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
