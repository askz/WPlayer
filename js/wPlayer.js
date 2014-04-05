function setPlayList()
		{
			/* TODO
			var music = new Array('id','path','title','artist','album','length','year','genre');
			*/
			for (var i = 0; i < list.length; i++) {
				soundManager.createSound({
				id: i.toString(),
				url: list[i]
				})
			};
		}

		function wPlayer(id){
			this.id = id;
			this.isPlaying = false;
			if (typeof this.init === 'undefined') {
				this.getPlayList = function()
				{
					document.getPlayList.submit();
				}

				this.next = function()
				{
					soundManager.stop(curMusic.toString());
					
					if (curMusic < this.list.length-1) {
						curMusic++;
					} 
					else{
						curMusic = 0;
					};
					
					soundManager.play(curMusic.toString());
				}

				this.prev = function()
				{
					soundManager.stop(curMusic.toString());
					

					if (curMusic == 0) {
						curMusic = this.list.length-1;
					} 
					else{
						curMusic--;
					};
					
					soundManager.play(curMusic.toString());
				}

				this.play = function()
				{
					
					soundManager.play(curMusic.toString());
				}

				this.pause = function()
				{
					soundManager.pause(curMusic.toString());
				}

				this.mute = function()
				{
					soundManager.toggleMute(curMusic.toString());
				}

				soundManager.setup(
				{
					url : './flash_dependeces/soundmanager2_debug.swf',
					flashVersion: 8,
					preferFlash: false,
					onready: function()
					{
						var playList = setPlayList(list);
					},
					ontimeout: function()
					{
						alert("Time out !");
					}
				});
				this.list = list;
				wPlayer.init = true;
			};
		}