;(function () {
	/* Lightweight EventEmitter implementation */
	EventEmitter = function () {}
	EventEmitter.prototype.on = function (evt, fn) {
		this._events = this._events || {}
		this._events[evt] = this._events[evt] || []
		this._events[evt].push(fn)
	}
	EventEmitter.prototype.off = function (evt, fn) {
		if (!this.hasOwnProperty('_events')) return
		if (evt in this._events === false) return
		this._events[evt].splice(this._events[evt].indexOf(fn), 1)
	}
	EventEmitter.prototype.emit = function (evt) {
		if (!this.hasOwnProperty('_events')) return
		if (evt in this._events === false) return

		for (var i = 0, l = this._events[evt].length; i < l; i++) {
			this._events[evt][i].apply(this, Array.prototype.slice.call(arguments, 1))
		}
	}

	/* Copy the stuff from Array to FileList */
	FileList.prototype.forEach = Array.prototype.forEach
	FileList.prototype.every = Array.prototype.every
	FileList.prototype.some = Array.prototype.some
	FileList.prototype.filter = Array.prototype.filter
	FileList.prototype.map = Array.prototype.map
	FileList.prototype.reduce = Array.prototype.reduce
	FileList.prototype.reduceRight = Array.prototype.reduceRight

	Object.defineProperty(FileList.prototype, "size", {
		get: function getSize () {
			return this.reduce(function (prev, curr) {
				return prev + curr.size
			}, 0)
		}
	})
	
	/* Utility to convert bytes into human units */
	var humanSize = {
		get: function humanSize () {
			var units = ["B", "KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"]
			var e = Math.floor(Math.log(this.size) / Math.log(1024))
			return (this.size / Math.pow(1024, e)).toFixed(2) + " " + units[e]
		}
	}
 	Object.defineProperty(FileList.prototype, "humanSize", humanSize)
	Object.defineProperty(File.prototype, "humanSize", humanSize)

	var percentUploaded = {
		get: function percentUploaded () {
			return this.uploadedSize / this.size
		}
	}
	Object.defineProperty(FileList.prototype, "percentUploaded", percentUploaded)
	Object.defineProperty(File.prototype, "percentUploaded", percentUploaded)

	Object.defineProperty(FileList.prototype, "uploadedSize", {
		get: function getUploadedSize () {
			return this.reduce(function (prev, curr) {
				return prev + (curr.uploadedSize || 0)
			}, 0)
		}
	})

	/* Object URL stuff */
	Object.defineProperty(File.prototype, "url", {
		get: function getURL () {
			return window.URL.createObjectURL(this);
		}
	})
	File.revokeURL = function revokeURL (url) {
		window.URL.revokeObjectURL(url)
	}

	// We manipulate this instead of files, because the fucking geniuses at
	// Mozilla interpreted the spec to mean that HTMLInputElement.prototype.files
	// is read-only.  It isn't, read for yourself:
	// http://www.w3.org/html/wg/drafts/html/master/forms.html#dom-input-files
	//HTMLInputElement.prototype.filelist = Object.create(FileList);
	/*
	Object.defineProperty(HTMLInputElement.prototype, "filelist", {
		get: function getFileList () {
			return this.filelist = this._filelist || this.files
		},
		set: function (files) {
			r
		}
	})*/

/*	HTMLInputElement.prototype.addEventListener("change", function (e) {
		this.filelist = e.target.files
	})*/

	// b gets merged as defaults for a
	var merge = function merge (base, overlay) {
		var out = base
		for (var key in overlay) {
			if (typeof overlay[key] === 'object')
				out[key] = merge(base[key], overlay[key]);
			else
				out[key] = overlay[key]
		}
		return out
	}
	
	var FileListUploader = function (url, files, opts) {
		this.url = url
		this.files = files

		opts = opts || {}
		
		this.opts = merge({
			'field': 'files[]',
			'method': 'POST',
			'data': {}
		}, opts)
	}
	FileListUploader.prototype = Object.create(EventEmitter.prototype)
	FileListUploader.prototype.upload = function (cb) {
		if (cb) this.on('uploadcomplete', cb)

		var opts = this.opts
		var files = this.files
		var events = this

		var data = new FormData()
		files.forEach(function (file) {
			data.append(opts.field, file)
		})

		var xhr = new XMLHttpRequest()

		xhr.open(opts.method, this.url, true)
		xhr.upload.addEventListener('loadstart', function (e) {
			for (var i = 0, l = files.length; i < l; i++) {
				files[i].uploadedSize = 0
			}
		})
		xhr.upload.addEventListener('progress', function (e) {
			if (e.lengthComputable) {
				size = e.loaded
				// We know the size of the files, the order they're in, and how
				// much we've uploaded.  Based on this data, we can do some magic 
				// to figure out which file we're on, and how much we've uploaded
				// of that file.
				// TODO: This math has trouble on later uploads.  Leak somewhere
				for (var i = 0, l = files.length; i < l; i++) {
					files[i].uploadedSize = Math.min(size, files[i].size)
					size -= files[i].uploadedSize
					if (size <= 0) {
						files.current = files[i]
						size = 0
					}
				}
			}
			events.emit('uploadprogress', e, files)
		}, false)
		xhr.upload.addEventListener('loadstart', function (e) { events.emit('uploadstart', e) })
		xhr.upload.addEventListener('load', function (e) { events.emit('uploadcomplete', e) })
		xhr.addEventListener('progress', function (e) { events.emit('progress', e) })
		xhr.addEventListener('load', function (e) { events.emit('load', e, xhr.responseText) })

		xhr.send(data)
		/* TODO: Add more event passthroughs, maybe abstract it into a helper? */
	}

	FileList.prototype.upload = function uploadFileList (url, opts) {
		return new FileListUploader(url, this, opts)
	}
})()
