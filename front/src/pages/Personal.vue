<template>
  <q-page>
    <q-table :rows="personals" :columns="personalColums" :filter="search">
      <template v-slot:top-right>
        <q-toolbar>
          <q-btn flat icon="add_circle_outline" @click="personalDialog = true;personalCrear=true" />
          <q-input v-model="search"  outlined  dense placeholder="Buscar..." />
        </q-toolbar>
      </template>

      <template v-slot:body-cell-option="props">
        <q-td :props="props" auto-width >
          <q-btn flat dense icon="o_edit" @click="personalEdit(props.row)" />
          <q-btn flat dense icon="o_delete" @click="personalDelete(props.row)" />
        </q-td>
      </template>
    </q-table>
    <q-dialog v-model="personalDialog" >
      <q-card style="width: 700px;max-width: 85vw">
        <q-card-section class="row items-center">
          <div class="text-h6">Agregar Usuario</div>
        </q-card-section>
        <q-card-section>
          <q-form @submit.prevent="personalCreate">
            <q-input v-model="personal.ci" hint="" required outlined label="ci" />
            <q-input v-model="personal.nombre" hint="" required outlined label="Nombres" />
            <q-input v-model="personal.apellido" hint="" required outlined label="Apellidos" />
            <q-input v-model="personal.telefono" hint="" required outlined label="Telefono" />
            <q-input v-model="personal.direccion" hint="" required outlined label="Direccion" />
            <q-btn :loading="loading" type="submit" color="primary" icon="add_circle_outline" label="Guardar" class="full-width" />
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <q-dialog v-model="personalModDialog" >
      <q-card style="width: 700px;max-width: 85vw">
        <q-card-section class="row items-center">
          <div class="text-h6">Agregar Usuario</div>
        </q-card-section>
        <q-card-section>
          <q-form @submit.prevent="personalUpdate">
            <q-input v-model="personal.ci" hint="" required outlined label="CI" />
            <q-input v-model="personal.nombre" hint="" required outlined label="Nombres" />
            <q-input v-model="personal.apellido" hint="" required outlined label="Apellidos" />
            <q-input v-model="personal.telefono" hint="" required outlined label="Telefono" />
            <q-input v-model="personal.direccion" hint="" required outlined label="Direccion" />
            <q-btn :loading="loading" type="submit" color="primary" icon="add_circle_outline" label="Guardar" class="full-width" />
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-page>
  </template>

  <script>
  export default {
    name: `personal`,
    data () {
      return {

        personalDialog: false,
        personalModDialog: false,
        search: '',
        personals: [],
        personal:{},
        loading: false,
        personalCrear: true,
        personalColums:[
          {name: 'option', field: 'option', label: 'Opciones', align: 'left', sortable: true},
          {name: 'id', label: 'ID', field: 'id', align: 'left', sortable: true},
          {name: 'nombre', label: 'Nombre', field: 'nombre', align: 'left', sortable: true},
          {name: 'apellido', label: 'apellido', field: 'apellido', align: 'left', sortable: true},
          {name: 'ci', label: 'ci', field: 'ci', align: 'left', sortable: true},
          {name: 'telefono', label: 'telefono', field: 'telefono', align: 'left', sortable: true},
          {name: 'direccion', label: 'direccion', field: 'direccion', align: 'left', sortable: true},
        ]
      }
    },
    methods:{
      personalUpdate(){
        this.loading = true
        this.$api.put(`personal/${this.personal.id}`,this.personal)
        .then(res=>{
          this.loading = false
          this.personalModDialog = false
          this.$q.notify({
            color: 'green-4',
            textColor: 'white',
            icon: 'check_circle',
            message: 'Usuario actualizado'
          })
          this.personal = {}
          this.personalsGet()
        })
        .catch(err=>{
          this.loading = false
          this.$q.notify({
            color: 'red-4',
            textColor: 'white',
            icon: 'error',
            message: 'Error al actualizar usuario'
          })
        })
      },
      personalsGet(){
        this.$q.loading.show()
        this.$api.get('personal').then(response => {
          this.personals = response.data
          this.$q.loading.hide()
        })
      },
      personalCreate(){

        if (this.personalCrear){
          this.loading = true
          this.$api.post('personal', this.personal).then(response => {
            this.personalsGet()
            this.personalDialog = false
            this.personal = {}
            this.loading = false
          }).catch(error => {
            this.loading = false
            this.$q.notify({
              color: 'negative',
              message: error.response.data.message,
              icon: 'report_problem',
              position: 'top'
            })
          })
        }else{
          this.loading = true
          this.$api.put('personal/'+this.personal.id, this.personal).then(response => {
            this.personalsGet()
            this.personalDialog = false
            this.personal = {}
            this.loading = false
          }).catch(error => {
            this.loading = false
            this.$q.notify({
              color: 'negative',
              message: error.response.data.message,
              icon: 'report_problem',
              position: 'top'
            })
          })
        }


      },
      personalEdit(personal){
        this.personal = personal
        this.personalCrear = false
        this.personalDialog = true
      },
      personalDelete(personal){
        this.$q.dialog({
          title: 'Eliminar',
          message: '¿Está seguro de eliminar el usuario?',
          ok: 'Si',
          cancel: 'No'
        }).onOk(() => {
          this.$q.loading.show()
          this.$api.delete('personal/'+personal.id).then(response => {
            this.personalsGet()
          })
        })
      }
    },
    created() {
      this.personalsGet()
    }
  }
  </script>

  <style scoped>

  </style>
