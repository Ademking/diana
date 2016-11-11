"use strict";var Chobi=function(t){if(t instanceof Image){this.image=t,this.imageData=this.extractImageData(),this["debugger"]("Type matched. instanceof(Image). Saved as [Chobi object]");try{this.onload()}catch(a){this["debugger"]("ready callback not found")}}else if("string"==typeof t){var e=this;this["debugger"]("Not instanceof(Image). Trying as URL");var i=new Image;i.crossOrigin="Anonymous",i.src=t,i.onload=function(){e.image=i,e.imageData=e.extractImageData(),e["debugger"]("Type matched. URL. Saved as [Chobi object]");try{e.onload()}catch(t){e["debugger"]("ready callback not found")}}}else{this["debugger"]("Not instanceof(Image). Trying as URL"),this["debugger"]("Not URL. Trying as input[file]");var e=this;try{var r=t.files[0],o=new FileReader;o.onload=function(){var t=new Image;t.onload=function(){e.image=t,e.imageData=e.extractImageData(),e["debugger"]("Type matched. input[file]. Saved as [Chobi object]");try{e.onload()}catch(a){e["debugger"]("ready callback not found")}},t.src=o.result},o.readAsDataURL(r)}catch(a){e["debugger"]("Not input[file]. Trying as <canvas>")}try{var i=new Image,h=t.toDataURL();i.src=h,this["debugger"](h),i.onload=function(){e.image=i,e.imageData=e.extractImageData(),e["debugger"]("Type matched. <canvas>. Saved as [Chobi object]");try{e.onload()}catch(t){e["debugger"]("ready callback not found")}}}catch(a){e["debugger"]("Not <canvas>. Trying as <img>")}try{var i=new Image;i.src=t.src,i.onload=function(){e.image=i,e.imageData=e.extractImageData(),e["debugger"]("Type matched. <img>. Saved as [Chobi object]");try{e.onload()}catch(t){e["debugger"]("ready callback not found")}}}catch(a){e["debugger"]("Not <img>. No other type is supported")}}};Chobi.prototype.debug=!1,Chobi.prototype["debugger"]=function(t){this.debug&&console.log(t)},Chobi.prototype.ready=function(t){this.onload=t},Chobi.prototype.onload=null,Chobi.prototype.extractImageData=function(){var t=this.image,a=document.createElement("canvas"),e=a.getContext("2d");return a.width=t.width,a.height=t.height,e.drawImage(t,0,0,t.width,t.height),this.imageData=e.getImageData(0,0,t.width,t.height),this.imageData},Chobi.prototype.getColorAt=function(t,a){var e=4*a*this.imageData.width+4*t,i={red:this.imageData.data[e],green:this.imageData.data[e+1],blue:this.imageData.data[e+2],alpha:this.imageData.data[e+3]};return i},Chobi.prototype.setColorAt=function(t,a,e){var i=4*a*this.imageData.width+4*t;try{return this.imageData.data[i]=e.red,this.imageData.data[i+1]=e.green,this.imageData.data[i+2]=e.blue,this.imageData.data[i+3]=e.alpha,!0}catch(r){return r}},Chobi.prototype.blackAndWhite=function(){for(var t=this.imageData,a=0;a<t.width;a++)for(var e=0;e<t.height;e++){var i=4*e*t.width+4*a,r=t.data[i],o=t.data[i+1],h=t.data[i+2],n=(r+o+h)/3;t.data[i]=n,t.data[i+1]=n,t.data[i+2]=n}return this},Chobi.prototype.blackAndWhite2=function(){for(var t=this.imageData,a=0;a<t.width;a++)for(var e=0;e<t.height;e++){var i=4*e*t.width+4*a,r=t.data[i],o=t.data[i+1],h=t.data[i+2],n=.3*r+.59*o+.11*h;t.data[i]=n,t.data[i+1]=n,t.data[i+2]=n}return this},Chobi.prototype.sepia=function(){for(var t=this.imageData,a=0;a<t.width;a++)for(var e=0;e<t.height;e++){var i=4*e*t.width+4*a,r=t.data[i],o=t.data[i+1],h=t.data[i+2];t.data[i]=.393*r+.769*o+.189*h,t.data[i+1]=.349*r+.686*o+.168*h,t.data[i+2]=.272*r+.534*o+.131*h}return this},Chobi.prototype.negative=function(){for(var t=this.imageData,a=0;a<t.width;a++)for(var e=0;e<t.height;e++){var i=4*e*t.width+4*a,r=t.data[i],o=t.data[i+1],h=t.data[i+2];t.data[i+3];r=255-r,o=255-o,h=255-h,t.data[i]=r,t.data[i+1]=o,t.data[i+2]=h}return this},Chobi.prototype.random=function(t,a){return Math.floor(Math.random()*(a-t+1))+t},Chobi.prototype.noise=function(){for(var t=this.imageData,a=0;a<t.width;a++)for(var e=0;e<t.height;e++){var i=4*e*t.width+4*a,r=(4*a*t.width+4*e,this.random(100,200)),o=this.random(100,200),h=this.random(100,200),n=(t.data[i]+r)/2,g=(t.data[i+1]+o)/2,d=(t.data[i+2]+h)/2;t.data[i]=n,t.data[i+1]=g,t.data[i+2]=d}return this},Chobi.prototype.contrast=function(t){var a=(255+t)/255;a*=a;for(var e=this.imageData,i=0;i<e.width;i++)for(var r=0;r<e.height;r++){var o=4*r*e.width+4*i,h=e.data[o],n=e.data[o+1],g=e.data[o+2],d=h/255,s=n/255,c=g/255;d=255*((d-.5)*a+.5),s=255*((s-.5)*a+.5),c=255*((c-.5)*a+.5),d>255&&(d=255),0>d&&(d=0),s>255&&(s=255),0>s&&(s=0),c>255&&(c=255),0>c&&(c=0),e.data[o]=d,e.data[o+1]=s,e.data[o+2]=c}return this},Chobi.prototype.crossProcess=function(){this.imageData;return this.vintage(),this.brightness(10),this.contrast(50),this},Chobi.prototype.map=function(t,a,e,i,r){return(r-i)*(t-a)/(e-a)+i},Chobi.prototype.brightness=function(t){var a=this.imageData;t=this.map(t,-100,100,-255,255),this["debugger"](t);for(var e=0;e<a.width;e++)for(var i=0;i<a.height;i++){var r=4*i*a.width+4*e,o=a.data[r],h=a.data[r+1],n=a.data[r+2];o+=t,h+=t,n+=t,o>255&&(o=255),0>o&&(o=0),h>255&&(h=255),0>h&&(h=0),n>255&&(n=255),0>n&&(n=0),a.data[r]=o,a.data[r+1]=h,a.data[r+2]=n}return this},Chobi.prototype.vintage=function(){for(var t=this.imageData,a=0;a<t.width;a++)for(var e=0;e<t.height;e++){var i=4*e*t.width+4*a,r=t.data[i],o=t.data[i+1],h=t.data[i+2];r=o,o=r,h=150,t.data[i]=r,t.data[i+1]=o,t.data[i+2]=h}return this.contrast(50),this},Chobi.prototype.crayon=function(){return this.noise().contrast(500),this},Chobi.prototype.cartoon=function(){return this.contrast(400),this},Chobi.prototype.watermark=function(t,a,e,i,r,o,h){var n=this;(""==h||null==h)&&(h=function(){this["debugger"]("Watermark method expects a callback")}),""==a&&(a=3),(""==e||null==e)&&(e=0),(""==i||null==i)&&(i=0),(""==r||null==r)&&(r=this.imageData.width),(""==o||null==o)&&(o=this.imageData.height);var g=new Chobi(t);g.ready(function(){this.resize(r,o);for(var t=0;t<this.imageData.width;t++)for(var g=0;g<this.imageData.height;g++){var d=n.getColorAt(t+e,g+i),s=this.getColorAt(t,g),c=(a*d.red+s.red)/(a+1),m=(a*d.green+s.green)/(a+1),u=(a*d.blue+s.blue)/(a+1),l={red:c,green:m,blue:u,alpha:d.alpha};n.setColorAt(t+e,g+i,l)}h()})},Chobi.prototype.resize=function(t,a){(""==t&&""==a||"auto"==t&&"auto"==a)&&(t=this.imageData.width,a=this.imageData.height),"auto"==t?t=a/this.imageData.height*this.imageData.width:"auto"==a&&(a=t/this.imageData.width*this.imageData.height);var e=document.createElement("canvas"),i=e.getContext("2d");return e.width=t,e.height=a,i.drawImage(this.getImage(),0,0,e.width,e.height),this.imageData=i.getImageData(0,0,t,a),this},Chobi.prototype.canvas=null,Chobi.prototype.loadImageToCanvas=function(t){null==t&&null!=this.canvas&&(t=this.canvas);try{var a=this.imageData,e=t.getContext("2d");return t.width=a.width,t.height=a.height,e.putImageData(a,0,0),!0}catch(i){return!1}return this},Chobi.prototype.getImage=function(){var t=document.createElement("canvas"),a=t.getContext("2d");t.width=this.imageData.width,t.height=this.imageData.height,a.putImageData(this.imageData,0,0);var e=document.createElement("img");return e.src=t.toDataURL("image/png"),e},Chobi.prototype.crop=function(t,a,e,i){if(""==t||""==a||""==e||""==i)return this["debugger"]("Invalid crop parameters"),this;if(0>t||0>a||t>this.imageData.width||a>this.imageData.height||t+e>this.imageData.width||a+i>this.imageData.height)return this["debugger"]("Invalid crop parameters"),this;var r=document.createElement("canvas");this.loadImageToCanvas(r);var o=r.getContext("2d"),h=o.getImageData(t,a,e,i);return this.imageData=h,this},Chobi.prototype.vignette=function(t){(""==t||null==t)&&(t=.1);for(var a=this.imageData.width/2,e=this.imageData.height/2,i=Math.sqrt(e*e+a*a),r=Math.sqrt((this.imageData.width/2-o)*(this.imageData.width/2-o)-(this.imageData.height/2-h)*(this.imageData.height/2-h)),o=0;o<this.imageData.width;o++)for(var h=0;h<this.imageData.height;h++){var n=this.getColorAt(o,h),r=Math.sqrt(Math.floor(Math.pow(o-e,2))+Math.floor(Math.pow(h-a,2)));n.red=n.red*(1-(1-t)*(r/i)),n.green=n.green*(1-(1-t)*(r/i)),n.blue=n.blue*(1-(1-t)*(r/i)),this.setColorAt(o,h,n)}return this},Chobi.prototype.download=function(t,a){""==t&&(t="untitled"),""==a&&(a="png");var e=this.imageData,i=document.createElement("canvas"),r=i.getContext("2d");i.width=e.width,i.height=e.height,r.putImageData(e,0,0);var o=i.toDataURL("image/"+a).replace("image/"+a,"image/octet-stream"),h=document.createElement("a");return"string"==typeof h.download?(document.body.appendChild(h),h.download=t+"."+a,h.href=o,h.click(),document.body.removeChild(h)):location.replace(uri),!0};