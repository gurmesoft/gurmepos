import{b as f,o,c as a,a as t,w as m,C as b,n as p,r}from"./vendor-3-6-0.js";const h={class:"relative inline-flex cursor-pointer"},x=["value","disabled"],g=t("div",{class:"w-11 min-w-[2.75rem] h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"},null,-1),_={class:"flex flex-col gap-1"},v={class:"flex items-center"},y={class:"ml-3 text-xs font-normal text-gray-400"},V={__name:"Switch",props:["modelValue","disabled","value"],emits:["update:modelValue"],setup(e,{emit:l}){const n=e,d=l,u=f({get(){return n.modelValue},set(s){d("update:modelValue",s)}});return(s,i)=>(o(),a("div",null,[t("label",h,[m(t("input",{"onUpdate:modelValue":i[0]||(i[0]=c=>u.value=c),value:e.value,type:"checkbox",class:"sr-only peer",disabled:e.disabled},null,8,x),[[b,u.value]]),g,t("div",_,[t("div",v,[t("span",{class:p(`ml-3 text-sm font-medium ${e.disabled?"text-gray-300":"text-gray-900"}`)},[r(s.$slots,"default")],2)]),t("span",y,[r(s.$slots,"subtitle")])])])]))}},k=["href"],w={key:1,type:"button",class:"!text-blue-700 border border-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"},B={__name:"OutlineButton",props:{href:{default:"",type:String}},setup(e){return(l,n)=>e.href?(o(),a("a",{key:0,href:e.href,class:"!text-blue-700 border border-blue-700 !focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"},[r(l.$slots,"default")],8,k)):(o(),a("button",w,[r(l.$slots,"default")]))}};export{V as _,B as a};
