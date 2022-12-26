<script setup>

</script>

<template>
    <div class="ant-card ant-card-bordered w-80 max-w-full" style="height: 100%; border-top: 5px solid rgb(0, 0, 0);">
        <div class="ant-card-body"
             style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
            <div style="flex: 1 1 0%;">
                <div class="SelectPlanModal-plan-header">
                    <div class="SelectPlanModal-plan-title"><span class="ant-tag ant-tag-has-color"
                                                                  style="background-color: rgb(0, 0, 0); font-size: 20px; padding: 5px 10px;">PRO</span>
                    </div>
                    <div class="SelectPlanModal-plan-price-month">
                        <div>175 руб.</div>
                        <div class="SelectPlanModal-plan-price-month-caption">/ {{$root.translate('month')}}</div>
                    </div>
                </div>
                <div class="SelectPlanModal-plan-price"><b>2100 руб.</b> {{$root.translate('per month')}}</div>
                <div class="SelectPlanModal-features">
                    <div class="SelectPlanModal-feature"><span role="img" aria-label="check-circle"
                                                               class="anticon anticon-check-circle"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="check-circle" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"
                        fill="#52c41a"></path><path
                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372 372-166.6 372-372-166.6-372-372-372zm193.4 225.7l-210.6 292a31.8 31.8 0 01-51.7 0L318.5 484.9c-3.8-5.3 0-12.7 6.5-12.7h46.9c10.3 0 19.9 5 25.9 13.3l71.2 98.8 157.2-218c6-8.4 15.7-13.3 25.9-13.3H699c6.5 0 10.3 7.4 6.4 12.7z"
                        fill="#f6ffed"></path><path
                        d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0051.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7z"
                        fill="#52c41a"></path></svg></span> {{$root.translate('Up to 10 pages')}}

                    </div>
                    <div class="SelectPlanModal-feature"><span role="img" aria-label="check-circle"
                                                               class="anticon anticon-check-circle"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="check-circle" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"
                        fill="#52c41a"></path><path
                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372 372-166.6 372-372-166.6-372-372-372zm193.4 225.7l-210.6 292a31.8 31.8 0 01-51.7 0L318.5 484.9c-3.8-5.3 0-12.7 6.5-12.7h46.9c10.3 0 19.9 5 25.9 13.3l71.2 98.8 157.2-218c6-8.4 15.7-13.3 25.9-13.3H699c6.5 0 10.3 7.4 6.4 12.7z"
                        fill="#f6ffed"></path><path
                        d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0051.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7z"
                        fill="#52c41a"></path></svg></span> {{$root.translate('Full analytics')}}
                    </div>
                    <div class="SelectPlanModal-feature"><span role="img" aria-label="check-circle"
                                                               class="anticon anticon-check-circle"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="check-circle" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"
                        fill="#52c41a"></path><path
                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372 372-166.6 372-372-166.6-372-372-372zm193.4 225.7l-210.6 292a31.8 31.8 0 01-51.7 0L318.5 484.9c-3.8-5.3 0-12.7 6.5-12.7h46.9c10.3 0 19.9 5 25.9 13.3l71.2 98.8 157.2-218c6-8.4 15.7-13.3 25.9-13.3H699c6.5 0 10.3 7.4 6.4 12.7z"
                        fill="#f6ffed"></path><path
                        d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0051.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7z"
                        fill="#52c41a"></path></svg></span> {{$root.translate('Custom HTML')}}
                    </div>
                    <div class="SelectPlanModal-feature"><span role="img" aria-label="check-circle"
                                                               class="anticon anticon-check-circle"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="check-circle" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"
                        fill="#52c41a"></path><path
                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372 372-166.6 372-372-166.6-372-372-372zm193.4 225.7l-210.6 292a31.8 31.8 0 01-51.7 0L318.5 484.9c-3.8-5.3 0-12.7 6.5-12.7h46.9c10.3 0 19.9 5 25.9 13.3l71.2 98.8 157.2-218c6-8.4 15.7-13.3 25.9-13.3H699c6.5 0 10.3 7.4 6.4 12.7z"
                        fill="#f6ffed"></path><path
                        d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0051.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7z"
                        fill="#52c41a"></path></svg></span> {{$root.translate('Own domain')}}
                    </div>
                    <div class="SelectPlanModal-feature"><span role="img" aria-label="check-circle"
                                                               class="anticon anticon-check-circle"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="check-circle" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"
                        fill="#52c41a"></path><path
                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372 372-166.6 372-372-166.6-372-372-372zm193.4 225.7l-210.6 292a31.8 31.8 0 01-51.7 0L318.5 484.9c-3.8-5.3 0-12.7 6.5-12.7h46.9c10.3 0 19.9 5 25.9 13.3l71.2 98.8 157.2-218c6-8.4 15.7-13.3 25.9-13.3H699c6.5 0 10.3 7.4 6.4 12.7z"
                        fill="#f6ffed"></path><path
                        d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0051.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7z"
                        fill="#52c41a"></path></svg></span> {{$root.translate('Hide QCD logo')}}
                    </div>
                    <div class="SelectPlanModal-feature"><span role="img" aria-label="check-ci=cle"
                                                               class="anticon anticon-check-circle"><svg
                        viewBox="64 64 896 896" focusable="false" data-icon="check-circle" width="1em" height="1em"
                        fill="currentColor" aria-hidden="true"><path
                        d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"
                        fill="#52c41a"></path><path
                        d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372 372-166.6 372-372-166.6-372-372-372zm193.4 225.7l-210.6 292a31.8 31.8 0 01-51.7 0L318.5 484.9c-3.8-5.3 0-12.7 6.5-12.7h46.9c10.3 0 19.9 5 25.9 13.3l71.2 98.8 157.2-218c6-8.4 15.7-13.3 25.9-13.3H699c6.5 0 10.3 7.4 6.4 12.7z"
                        fill="#f6ffed"></path><path
                        d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0051.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7z"
                        fill="#52c41a"></path></svg></span> {{$root.translate('Support priority')}}
                    </div>
                </div>
            </div>
            <button type="button" class="ant-btn ant-btn-primary ant-btn-block"><span>{{$root.translate('Buy PRO')}}</span></button>
        </div>
    </div>
</template>
