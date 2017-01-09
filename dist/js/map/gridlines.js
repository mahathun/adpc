var countX = 29;//cells by x
var countY = 54;//cells by y
var cellWidth = 12.7600021 / countX;
var cellHeight = 23.7600012 / countY;
var col3 = [];
var coordinates = [],
    c = {x: 89.7599945, y: 30.6000004},//cursor
    //top-left/top-right/bottom-right/bottom-left
    tLx, tLy,   tRx, tRy,
    bRx, bRy,   bLx, bLy;

// build coordinates array, from top-left to bottom-right
//count by row
for(var iY = 0; iY < countY; iY++){
  //count by cell in row
  for(var iX = 0; iX < countX; iX++){
    tLx = bLx = c.x;
    tLy = tRy = c.y;
    tRx = bRx =c.x + cellWidth;
    bRy = bLy = c.y - cellHeight;
    var cell = [
      //top-left/top-right/bottom-right/bottom-left/top-left
      [tLx, tLy], [tRx, tRy], [bRx, bRy], [bLx, bLy], [tLx, tLy]
    ];
    coordinates.push(cell);
    //refresh cusror for cell
    c.x = c.x + cellWidth;
  }
  //refresh cursor for row
  c.x = 89.7599945;
  c.y = c.y - cellHeight;
}
function getColorCode(currentrow,col3,colorset) {
	var color;
switch(colorset)
{
case 1:	
		var normalize=Math.floor(((col3[currentrow]-Math.min.apply(null, col3))/(Math.max.apply(null, col3)-Math.min.apply(null, col3)))*16);
		switch(normalize)
		{
	case 0: color='#010101' ; break;
	case 1 : color='#A403A7'  ; break;
	case 2 : color='#00038B' ; break;
	case 3 : color='#0630A8' ; break;
	case 4 : color='#0067C2' ; break;
	case 5 : color='#0395DE'; break;
	case 6 : color='#00CBEC'  ; break;
	case 7 : color='#05FDFC'  ; break;
	case 8 : color='#30F6AB'  ; break;
	case 9 : color=' #4CF657'  ; break;
	case 10 : color='#7EEB06'  ; break;
	case 11 : color='#FAF803'  ; break;
	case 12 : color='#F9C802'  ; break;
	case 13 : color='#F99600'  ; break;
	case 14 : color='#FF5F09'  ; break;
	case 15 : color='#EB0104'  ; break;
	case 16 : color='#58ac2b'  ; break;
		}
		break;
case 2:
		var normalize=Math.floor(((col3[currentrow]-Math.min.apply(null, col3))/(Math.max.apply(null, col3)-Math.min.apply(null, col3)))*48);
		switch(normalize)
		{
		case 0: color='#2f235d' ; break;
		case 1 : color='#2d2759'  ; break;
		case 2 : color='#2b2b55' ; break;
		case 3 : color='#23252d' ; break;
		case 4 : color='#26354b ' ; break;
		case 5 : color='#243947'; break;
		case 6 : color='#19343a'  ; break;
		case 7 : color='#0e641c'  ; break;
		case 8 : color='#0c6818'  ; break;
		case 9 : color='#0a6c14'  ; break;
		case 10 : color='#1a371c'  ; break;
		case 11 : color='#05760a'  ; break;
		case 12 : color='#037a06'  ; break;
		case 13 : color='#007600'  ; break;
		case 14 : color='#48a423'  ; break;
		case 15 : color='#50a827'  ; break;
		case 16 : color='#58ac2b'  ; break;
		case 17 : color='#334825'  ; break;
		case 18 : color='#6cb635'  ; break;
		case 19 : color='#74ba39'  ; break;
		case 20 : color='#74b634'  ; break;
		case 21 : color='#908e3c' ; break;
		case 22 : color='#8f8a39'  ; break;
		case 23 : color='#8f8737'  ; break;
		case 24 : color='#34311b'  ; break;
		case 25 : color='#8e8031'  ; break;
		case 26 : color='#8e7d2e'  ; break;
		case 27 : color='#887526'  ; break;
		case 28 : color='#f2ad3b' ; break;
		case 29 : color='#f1a837'  ; break;
		case 30 : color='#f0a333'  ; break;
		case 31 : color='#584224'  ; break;
		case 32 : color='#ee9729'  ; break;
		case 33 : color='#ed9225'  ; break;
		case 34 : color='#e58518'  ; break;
		case 35 : color='#e85e00'  ; break;
		case 36 : color='#e95800'  ; break;
		case 37 : color='#eb5100'  ; break;
		case 38 : color='#582b18'  ; break;
		case 39 : color='#ef4200' ; break;
		case 40 : color='#f03b00'  ; break;
		case 41 : color='#ea2c00'  ; break;
		case 42 : color='#ff0006'  ; break;
		case 43 : color='#ff000c'  ; break;
		case 44 : color='#fb0013'  ; break;
		case 45 : color='#5a181f'  ; break;
		case 46 : color='#f10021'  ; break;
		case 47 : color='#ec0027'  ; break;
		case 48 : color='#df0024'  ; break;

		}
		break;
		
	case 3:
		var normalize=Math.floor(((col3[currentrow]-Math.min.apply(null, col3))/(Math.max.apply(null, col3)-Math.min.apply(null, col3)))*255);
		switch(normalize)
		{
	
		case 	0	: color='	#040000	' ; break;
		case 	1	: color='	#710037	' ; break;
		case 	2	: color='	#710040	' ; break;
		case 	3	: color='	#70014D	' ; break;
		case 	4	: color='	#770251	' ; break;
		case 	5	: color='	#790255	' ; break;
		case 	6	: color='	#7D005E	' ; break;
		case 	7	: color='	#7B0467	' ; break;
		case 	8	: color='	#880072	' ; break;
		case 	9	: color='	#800476	' ; break;
		case 	10	: color='	#87037B	' ; break;
		case 	11	: color='	#94007C	' ; break;
		case 	12	: color='	#960082	' ; break;
		case 	13	: color='	#8E048F	' ; break;
		case 	14	: color='	#910395	' ; break;
		case 	15	: color='	#970299	' ; break;
		case 	16	: color='	#A100A7	' ; break;
		case 	17	: color='	#96009F	' ; break;
		case 	18	: color='	#8C009F	' ; break;
		case 	19	: color='	#81009B	' ; break;
		case 	20	: color='	#77009C	' ; break;
		case 	21	: color='	#6F009C	' ; break;
		case 	22	: color='	#63009B	' ; break;
		case 	23	: color='	#62009B	' ; break;
		case 	24	: color='	#510096	' ; break;
		case 	25	: color='	#460099	' ; break;
		case 	26	: color='	#3C0096	' ; break;
		case 	27	: color='	#310195	' ; break;
		case 	28	: color='	#280094	' ; break;
		case 	29	: color='	#1E0094	' ; break;
		case 	30	: color='	#160093	' ; break;
		case 	31	: color='	#0D008E	' ; break;
		case 	32	: color='	#00018F	' ; break;
		case 	33	: color='	#000392	' ; break;
		case 	34	: color='	#000793	' ; break;
		case 	35	: color='	#000B95	' ; break;
		case 	36	: color='	#010E9A	' ; break;
		case 	37	: color='	#00109B	' ; break;
		case 	38	: color='	#001499	' ; break;
		case 	39	: color='	#001997	' ; break;
		case 	40	: color='	#001A9C	' ; break;
		case 	41	: color='	#011E9E	' ; break;
		case 	42	: color='	#01209F	' ; break;
		case 	43	: color='	#01239E	' ; break;
		case 	44	: color='	#0027A0	' ; break;
		case 	45	: color='	#0129A2	' ; break;
		case 	46	: color='	#002DA4	' ; break;
		case 	47	: color='	#012FA8	' ; break;
		case 	48	: color='	#0330AD	' ; break;
		case 	49	: color='	#0036AA	' ; break;
		case 	50	: color='	#0039AA	' ; break;
		case 	51	: color='	#033DAB	' ; break;
		case 	52	: color='	#0040AC	' ; break;
		case 	53	: color='	#0043AE	' ; break;
		case 	54	: color='	#0045AF	' ; break;
		case 	55	: color='	#004CB0	' ; break;
		case 	56	: color='	#034CB2	' ; break;
		case 	57	: color='	#014FB3	' ; break;
		case 	58	: color='	#0053B5	' ; break;
		case 	59	: color='	#0056B7	' ; break;
		case 	60	: color='	#0058B9	' ; break;
		case 	61	: color='	#005DBA	' ; break;
		case 	62	: color='	#0161B8	' ; break;
		case 	63	: color='	#0863B5	' ; break;
		case 	64	: color='	#0264BD	' ; break;
		case 	65	: color='	#0069C1	' ; break;
		case 	66	: color='	#006DC0	' ; break;
		case 	67	: color='	#0071C1	' ; break;
		case 	68	: color='	#0075C4	' ; break;
		case 	69	: color='	#01A8DC	' ; break;
		case 	70	: color='	#0079C4	' ; break;
		case 	71	: color='	#0379D2	' ; break;
		case 	72	: color='	#0081CC	' ; break;
		case 	73	: color='	#0084CC	' ; break;
		case 	74	: color='	#0087C9	' ; break;
		case 	75	: color='	#008ACB	' ; break;
		case 	76	: color='	#008DCD	' ; break;
		case 	77	: color='	#0090CF	' ; break;
		case 	78	: color='	#0294D0	' ; break;
		case 	79	: color='	#0494D0	' ; break;
		case 	80	: color='	#0099D5	' ; break;
		case 	81	: color='	#019CD4	' ; break;
		case 	82	: color='	#009FD6	' ; break;
		case 	83	: color='	#00A5D9	' ; break;
		case 	84	: color='	#00A6DA	' ; break;
		case 	85	: color='	#01A8DC	' ; break;
		case 	86	: color='	#00ACDE	' ; break;
		case 	87	: color='	#05ACE3	' ; break;
		case 	88	: color='	#01B2E4	' ; break;
		case 	89	: color='	#02B5DE	' ; break;
		case 	90	: color='	#00B9E0	' ; break;
		case 	91	: color='	#00BCE2	' ; break;
		case 	92	: color='	#00BFE4	' ; break;
		case 	93	: color='	#01C4E4	' ; break;
		case 	94	: color='	#00C6E7	' ; break;
		case 	95	: color='	#05C6E8	' ; break;
		case 	96	: color='	#00CCEB	' ; break;
		case 	97	: color='	#00CFE9	' ; break;
		case 	98	: color='	#02D2EC	' ; break;
		case 	99	: color='	#02D6EE	' ; break;
		case 	100	: color='	#02DAEF	' ; break;
		case 	101	: color='	#01DCF0	' ; break;
		case 	102	: color='	#02DDF1	' ; break;
		case 	103	: color='	#05E1F1	' ; break;
		case 	104	: color='	#06E4F2	' ; break;
		case 	105	: color='	#05E9F6	' ; break;
		case 	106	: color='	#02ECF7	' ; break;
		case 	107	: color='	#01EFF9	' ; break;
		case 	108	: color='	#01F2FB	' ; break;
		case 	109	: color='	#01F4FA	' ; break;
		case 	110	: color='	#00FCFE	' ; break;
		case 	111	: color='	#00FBFF	' ; break;
		case 	112	: color='	#04FDFF	' ; break;
		case 	113	: color='	#00FFF8	' ; break;
		case 	114	: color='	#06FEF0	' ; break;
		case 	115	: color='	#09FDF3	' ; break;
		case 	116	: color='	#0DFDE0	' ; break;
		case 	117	: color='	#11FAE7	' ; break;
		case 	118	: color='	#0FFCDE	' ; break;
		case 	119	: color='	#0AFEE6	' ; break;
		case 	120	: color='	#13FCDC	' ; break;
		case 	121	: color='	#0FFFCB	' ; break;
		case 	122	: color='	#20F7CE	' ; break;
		case 	123	: color='	#20F9C2	' ; break;
		case 	124	: color='	#24F8BD	' ; break;
		case 	125	: color='	#26F7BD	' ; break;
		case 	126	: color='	#28F8B4	' ; break;
		case 	127	: color='	#2FF3AF	' ; break;
		case 	128	: color='	#2DF7AB	' ; break;
		case 	129	: color='	#2DF8A9	' ; break;
		case 	130	: color='	#33F59E	' ; break;
		case 	131	: color='	#31F999	' ; break;
		case 	132	: color='	#31FA94	' ; break;
		case 	133	: color='	#39F395	' ; break;
		case 	134	: color='	#41F18B	' ; break;
		case 	135	: color='	#3BF884	' ; break;
		case 	136	: color='	#41F675	' ; break;
		case 	137	: color='	#49F177	' ; break;
		case 	138	: color='	#42F671	' ; break;
		case 	139	: color='	#4FF06E	' ; break;
		case 	140	: color='	#50F06C	' ; break;
		case 	141	: color='	#57EE65	' ; break;
		case 	142	: color='	#59ED61	' ; break;
		case 	143	: color='	#60EC56	' ; break;
		case 	144	: color='	#52F357	' ; break;
		case 	145	: color='	#59F151	' ; break;
		case 	146	: color='	#5DF04A	' ; break;
		case 	147	: color='	#5EF047	' ; break;
		case 	148	: color='	#63F03F	' ; break;
		case 	149	: color='	#65F03B	' ; break;
		case 	150	: color='	#63EE33	' ; break;
		case 	151	: color='	#65F22E	' ; break;
		case 	152	: color='	#69EF2D	' ; break;
		case 	153	: color='	#6DEC21	' ; break;
		case 	154	: color='	#72ED20	' ; break;
		case 	155	: color='	#73EB1A	' ; break;
		case 	156	: color='	#74ED14	' ; break;
		case 	157	: color='	#7BEA0F	' ; break;
		case 	158	: color='	#7CEA0B	' ; break;
		case 	159	: color='	#7EEA01	' ; break;
		case 	160	: color='	#83E808	' ; break;
		case 	161	: color='	#88EB00	' ; break;
		case 	162	: color='	#90ED00	' ; break;
		case 	163	: color='	#9AEE02	' ; break;
		case 	164	: color='	#9FEF00	' ; break;
		case 	165	: color='	#AAF100	' ; break;
		case 	166	: color='	#B3F201	' ; break;
		case 	167	: color='	#B7F700	' ; break;
		case 	168	: color='	#BEF500	' ; break;
		case 	169	: color='	#C8F600	' ; break;
		case 	170	: color='	#D0F700	' ; break;
		case 	171	: color='	#D8F800	' ; break;
		case 	172	: color='	#E0FB00	' ; break;
		case 	173	: color='	#E5FA00	' ; break;
		case 	174	: color='	#EFFC00	' ; break;
		case 	175	: color='	#F7FF00	' ; break;
		case 	176	: color='	#F5FD00	' ; break;
		case 	177	: color='	#F4FA00	' ; break;
		case 	178	: color='	#F6F401	' ; break;
		case 	179	: color='	#F8F200	' ; break;
		case 	180	: color='	#F6EF00	' ; break;
		case 	181	: color='	#AAF100	' ; break;
		case 	182	: color='	#F6E900	' ; break;
		case 	183	: color='	#FAE601	' ; break;
		case 	184	: color='	#F6E400	' ; break;
		case 	185	: color='	#F6DE02	' ; break;
		case 	186	: color='	#F8DB01	' ; break;
		case 	187	: color='	#FBA600	' ; break;
		case 	188	: color='	#F7D502	' ; break;
		case 	189	: color='	#F7D100	' ; break;
		case 	190	: color='	#FBCE01	' ; break;
		case 	191	: color='	#F7CC04	' ; break;
		case 	192	: color='	#F8C802	' ; break;
		case 	193	: color='	#FBC501	' ; break;
		case 	194	: color='	#F9C101	' ; break;
		case 	195	: color='	#F9BE00	' ; break;
		case 	196	: color='	#F7BC00	' ; break;
		case 	197	: color='	#F7B500	' ; break;
		case 	198	: color='	#F8B600	' ; break;
		case 	199	: color='	#FFB000	' ; break;
		case 	200	: color='	#F8AC00	' ; break;
		case 	201	: color='	#F9AD01	' ; break;
		case 	202	: color='	#FAA700	' ; break;
		case 	203	: color='	#FBA600	' ; break;
		case 	204	: color='	#FAA401	' ; break;
		case 	205	: color='	#F99F00	' ; break;
		case 	206	: color='	#FC9A01	' ; break;
		case 	207	: color='	#FA9705	' ; break;
		case 	208	: color='	#FF9200	' ; break;
		case 	209	: color='	#FF9200	' ; break;
		case 	210	: color='	#FA8F01	' ; break;
		case 	211	: color='	#FB8C00	' ; break;
		case 	212	: color='	#FA8A00	' ; break;
		case 	213	: color='	#FB8500	' ; break;
		case 	214	: color='	#F58700	' ; break;
		case 	215	: color='	#F68400	' ; break;
		case 	216	: color='	#FC7C00	' ; break;
		case 	217	: color='	#F97800	' ; break;
		case 	218	: color='	#FC7500	' ; break;
		case 	219	: color='	#FB7200	' ; break;
		case 	220	: color='	#FD6F03	' ; break;
		case 	221	: color='	#FD6C01	' ; break;
		case 	222	: color='	#FD6801	' ; break;
		case 	223	: color='	#F66906	' ; break;
		case 	224	: color='	#FE6102	' ; break;
		case 	225	: color='	#FA6000	' ; break;
		case 	226	: color='	#FB5C00	' ; break;
		case 	227	: color='	#FB5A02	' ; break;
		case 	228	: color='	#FA5601	' ; break;
		case 	229	: color='	#FC5300	' ; break;
		case 	230	: color='	#FF4B00	' ; break;
		case 	231	: color='	#FF4C03	' ; break;
		case 	232	: color='	#FD4801	' ; break;
		case 	233	: color='	#FC4700	' ; break;
		case 	234	: color='	#FD4401	' ; break;
		case 	235	: color='	#FD3F01	' ; break;
		case 	236	: color='	#FA3C00	' ; break;
		case 	237	: color='	#FF3700	' ; break;
		case 	238	: color='	#FB3601	' ; break;
		case 	239	: color='	#F93702	' ; break;
		case 	240	: color='	#F63500	' ; break;
		case 	241	: color='	#FF2C00	' ; break;
		case 	242	: color='	#E72F14	' ; break;
		case 	243	: color='	#FA2600	' ; break;
		case 	244	: color='	#FC2105	' ; break;
		case 	245	: color='	#F91E08	' ; break;
		case 	246	: color='	#F51F00	' ; break;
		case 	247	: color='	#F21C02	' ; break;
		case 	248	: color='	#EB1A00	' ; break;
		case 	249	: color='	#F01600	' ; break;
		case 	250	: color='	#EF1100	' ; break;
		case 	251	: color='	#EF0D00	' ; break;
		case 	252	: color='	#EE0A00	' ; break;
		case 	253	: color='	#ED0600	' ; break;
		case 	254	: color='	#EC0300	' ; break;
		case 	255	: color='	#E90300	' ; break;
		}
		break;

}
		
    return color;
}
/* function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
} */
var grid = {
				type: 'FeatureCollection',
				features: []
				};
for(var i = 0; i< countX*countY; i++){		
				grid.features.push({
						type: 'Feature',
						geometry: {
						type:  'Polygon',
						coordinates: [coordinates[i]]
						}						
				});
		}
function filterResult(arayTest,value)
{
		return checkinProvinceArea(arayTest,value);

}
function createlayeringrid(valueset,arayTest,colorset)
{
		var gridlayer = {
				type: 'FeatureCollection',
				features: []
				};
		col3 = [];
		for(var m= 0; m<valueset.length;m++)
		{
		col3.push(valueset[m][2]);
		}
		
		for(var i = 0; i< valueset.length; i++){
				if(filterResult(arayTest,Number(valueset[i][0])*29+Number(valueset[i][1])))
				{
				gridlayer.features.push({
						type: 'Feature',
						geometry: {
						type:  'Polygon',
						coordinates: [coordinates[Number(valueset[i][0])*29+Number(valueset[i][1])]]
						},
						 colorv:getColorCode(i,col3,colorset)
				});
				}
		}
		
		return gridlayer;
}
function minRangeGet(valueset)
{
	return Math.min.apply(null, col3);
}
function maxRangeGet(valueset)
{
	return Math.max.apply(null, col3);
}
				


