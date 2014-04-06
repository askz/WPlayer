		function setPlayList()
		{
			var music = Array(list.length-1);
			for (var i = 0; i < list.length; i++) {
				music[i] = soundManager.createSound({
				id: i.toString(),
				url: list[i]
				})
			};
			return music;
		}

		function change_img(id)
		{
			var img = document.getElementById(id);


			if (img.id.search("_select") >= 4) {
				id = id.replace("_select", "");
				img.setAttribute('id', id);

			} else{
				img.setAttribute('id', id + "_select");
			};
		}

		function wPlayer(id){
			this.id = id;
			this.isPlaying = false;
			this.volume = 50;
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

				this.play = function(id)
				{
					soundManager.togglePause(curMusic.toString());
					var img = document.getElementById(id);

					if (img.id.localeCompare("play") == 0) {
						id = id.replace("play", "play_select");
						img.setAttribute('id', id);
					} 
					else if (img.id.localeCompare("play_select") == 0) {
						id = id.replace("play", "pause");
						img.setAttribute('id', id);
					}
					else if (img.id.localeCompare("pause_select") == 0) {
						id = id.replace("pause", "play");
						img.setAttribute('id', id);
					};
				}
				this.pause = function()
				{
					soundManager.pause(curMusic.toString());
				}

				this.mute = function(id)
				{
					soundManager.toggleMute(curMusic.toString());
					change_img(id);
				}

				this.volUp = function()
				{
					if (this.volume < 100) 
						{this.volume += 10;};
				 	soundManager.setVolume(curMusic.toString(),this.volume);
				}

				this.volDown = function()
				{
					if (this.volume > 0) 
						{this.volume -= 10;};
					soundManager.setVolume(curMusic.toString(),this.volume);
				}
				
				soundManager.setup(
				{
					url : './flash_dependeces/soundmanager2_debug.swf',
					flashVersion: 8,
					preferFlash: false,
					onready: function()
					{
						soundManager.setVolume(this.volume);
						var playList = setPlayList(list);
						playList[0].onfinish(player.next);
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

		var list = ['./test1.mp3','./test2.mp3','./test3.mp3'];
		var curMusic = 0;
		var player = new wPlayer("test");