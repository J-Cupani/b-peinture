<template>
  <div :class="{mandatory, 'no-file':!file.isUploaded}" class="file-upload">
    <div class="file-upload__area" @drop.prevent="drop" @dragover.prevent>
      <div v-if="!file.isUploaded" class="text-center">
        <input id="fileUpload" type="file" @change="handleFileChange($event)" />
        <label for="fileUpload">Déposer votre fichier ici ou <u>cliquer ici</u> pour uploader.</label>

        <div v-if="errors.length > 0">
          <div
            v-for="(error, index) in errors"
            :key="index"
            class="file-upload__error"
          >
            <span>{{ error }}</span>
          </div>
        </div>
      </div>

      <div v-if="file.isUploaded" class="upload-preview">
        <div class="d-flex align-center justify-center">
          <div :class="['preview mr-6', { 'sixteen-nine': props.isSixteenNine }, { 'one-one': !props.isSixteenNine }]">
            <div :class="['file-image-container', { 'sixteen-nine': props.isSixteenNine }]">
              <img :src="file.url" alt="" class="file-image" v-if="file.isImage" />
            </div>

            <div v-if="!file.isImage" class="file-extention">
              {{ file.extension }}
            </div>
          </div>

          <div>
            <div class="mb-2">Autorisé {{ props.accept }}.<br>
              Taille max. {{ props.maxSize }} MB
            </div>
            <vBtn v-if="file.isEditable" color="primary-light" prepend-icon="tabler-reload" @click="resetFileInput">
              Modifier
            </vBtn>
          </div>

        </div>
        <div class="mt-2 text-center">{{ file.filenameOriginal }}</div>
      </div>
    </div>
    <v-messages v-if="mandatory" :active="mandatory" class="mt-2" color="red" messages="le fichier est obligatoire" />
  </div>
</template>

<script setup>
// Emit
const emit = defineEmits(["update:mandatory", "update:file"])

// Props
const props = defineProps({
  maxSize: {
    type: Number,
    default: 5,
    required: true
  },
  accept: {
    type: String,
    default: "jpg,jpeg,png,svg"
  },
  mandatory: {
    type: Boolean,
    default: true
  },
  file: {
    type: Object
  },
  isSixteenNine: {
    type: Boolean,
    default: false
  }
})

// Data
const errors = ref([])
const uploadReady = ref(true)

// Computed
const file = computed({
  get: () => {
    return props.file !== null ? props.file : {
      name: "",
      size: 0,
      type: "",
      extension: "",
      url: "",
      isImage: false,
      isUploaded: false,
      isEditable: true,
      isDelete: false,
      isNew: false
    }
  },
  set: (value) => {
    //emit('update:isOpen', value)
  }
})

// Methods
const drop = (e) => {
  FileChangeAction(e.dataTransfer.files)
}
const handleFileChange = (e) => {
  FileChangeAction(e.target.files)
}
const FileChangeAction = (files) => {
  errors.value = []
  // Check if file is selected
  if (files && files[0]) {
    // Check if file is valid
    if (isFileValid(files[0])) {
      // Get uploaded file
      const fileUpload = files[0],
        // Get file size
        fileSize = Math.round((fileUpload.size / 1024 / 1024) * 100) / 100,
        // Get file extension
        extension = fileUpload.name.split(".").pop(),
        // Get file name
        fileName = fileUpload.name.split(".").shift(),
        // Check if file is an image
        isImage = ["jpg", "jpeg", "png", "svg"].includes(extension)

      // Load the FileReader API
      let reader = new FileReader()
      reader.addEventListener(
        "load",
        () => {
          emit("update:mandatory", null)
          // Set file data
          emit("update:file", {
            filenameOriginal: fileName,
            name: fileName,
            size: fileSize,
            type: fileUpload.type,
            extension: extension,
            isImage: isImage,
            url: URL.createObjectURL(fileUpload),
            binary: fileUpload,
            isUploaded: true,
            isEditable: true,
            isDelete: false,
            isNew: true
          })
        },
        false
      )
      // Read uploaded file
      reader.readAsDataURL(fileUpload)
    }
  }
}
const isFileSizeValid = (fileSize) => {
  if (fileSize > props.maxSize) {
    errors.value.push(`La taille du fichier doit être inférieure à ${props.maxSize} MB`)
  }
}
const isFileTypeValid = (extension) => {
  if (!props.accept.split(",").includes(extension.toLowerCase())) {
    errors.value.push(`Le type de fichier doit être ${props.accept}`)
  }
}

const isFileValid = (file) => {
  isFileSizeValid(Math.round((file.size / 1024 / 1024) * 100) / 100)
  isFileTypeValid(file.name.split(".").pop())
  return errors.value.length === 0
}

const resetFileInput = async () => {
  uploadReady.value = false
  await nextTick()
  uploadReady.true = false
  emit("update:file", {
    filenameOriginal: "",
    name: "",
    size: 0,
    type: "",
    data: "",
    extension: "",
    url: "",
    isImage: false,
    isUploaded: false,
    isEditable: true,
    isDelete: true,
    isNew: false
  })
}
</script>

<style lang="scss" scoped>
.file-upload {
  margin: 0 auto;

  .file-upload__area {
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  &.no-file {
    .file-upload__area {
      border: 2px dashed #ccc;
    }
  }

  &.mandatory {
    .file-upload__area {
      border: 2px dashed #f00;
    }
  }

  .file-upload__error {
    margin-top: 10px;
    color: #f00;
    font-size: 12px;
  }

  .upload-preview {
    position: relative;
    width: 100%;

    .preview {
      &.sixteen-nine {
        width: 260px;
      }

      &.one-one {
        width: 160px;
      }
    }

    .file-image-container {
      height: 0;
      overflow: hidden;
      box-sizing: border-box;
      position: relative;
      margin-bottom: 1rem;
      width: 100%;
      padding-top: 100%;

      &.sixteen-nine {
        padding-top: 56.25%; // 16:9 aspect ratio
      }

      .file-image {
        width: 100%;
        vertical-align: top;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
      }
    }

    .file-extention {
      height: 100px;
      width: 100px;
      border-radius: 8px;
      background: #ccc;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0.5em auto;
      font-size: 1.2em;
      padding: 1em;
      text-transform: uppercase;
      font-weight: 500;
    }

    .file-name {
      font-size: .9em;
      font-weight: 300;
      color: #000;
      opacity: 0.5;
    }
  }
}

#fileUpload {
  display: none;
}

label {
  cursor: pointer;
}
</style>
