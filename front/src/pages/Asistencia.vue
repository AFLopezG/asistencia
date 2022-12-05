<template>
  <q-page>

    <q-card>
      <q-card-section>
        <div class="row">
            <div class="col-6">
              <small class="text-bold text-subtitle1">Fecha actual:</small> {{ fechaActual }}
            </div>

          <div class="col-12 q-px-lg">
            <q-form @submit.prevent="regsitroAsistencia">
              <q-input label="Colocar el lector"   v-model="ci" outlined />
            </q-form>
            <!--<q-btn color="accent" icon="print" label="Re Impresion" @click="refrigerioPrint" />-->
          </div>
        </div>
      </q-card-section>
    </q-card>
    <div class="row">


    </div>
    <div id="myelement" class="hidden"></div>
  </q-page>
</template>

<script>
import {date} from "quasar";

export default {
  name: `Asistencia`,
  data() {
    return {
      ci: '',
      turno: 'MAÑANA',
      fechaActual: date.formatDate(new Date(), 'DD/MM/YYYY'),
      total:0,
      manana:0,
      tarde:0,
    }
  },
  created() {
  this.totalreg()
  },
  methods: {
    regsitroAsistencia(){
      this.$q.loading.show()
      this.$api.post('asistencia/',{
        ci: this.ci,
        fecha: date.formatDate(new Date(), 'YYYY-MM-DD'),
        hora: date.formatDate(new Date(), 'HH:mm:ss')
      })
        .then((response) => {
          this.totalreg()
          this.$q.loading.hide()
          this.$q.notify({
            message: 'Se ha registro',
            color: 'green-4',
            textColor: 'white',
            icon: 'done',
            position: 'top',
          })

      })
        .catch((error) => {
          this.$q.loading.hide()
          this.$q.notify({
            message: error.response.data.message,
            color: 'red-4',
            textColor: 'white',
            icon: 'error',
            position: 'top',
          })
        })

    },
    totalreg(){
      this.$api.post('asistencia',{
        fecha: date.formatDate(new Date(), 'YYYY-MM-DD'),
      })
        .then(response => {
          console.log(response.data)
        })
        .catch(error => {
          console.log(error)
        })
    },



  },
}
</script>

<style scoped>

</style>
