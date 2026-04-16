/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/GUIForms/JFrame.java to edit this template
 */
package restoswing;
import java.net.URI;
import java.awt.event.*;
import java.net.http.*;
import java.util.*;
import org.json.*;
/**
 *
 * @author antoine
 */
public class Commande_liste extends javax.swing.JFrame {
    
    ArrayList<Commande> commandes; // collection des commandes
    ArrayList<Ligne> lignes; // collection des lignes
    
    static final String API_url = "http://localhost/projet/appRoseBlanche/api/commandes_en_attente.php";
    String url;
    /**
     * Creates new form MyJFrame
     */
    public Commande_liste() {
        initComponents();
        get_data();
    }
    
    // Appelle l'api et remplit la table des commandes
    public void get_data(){
        commandes = new ArrayList<>(); // reinitialise la collection des commandes
        
        String json = ""; // le json brut      
        int i = 0; // indice sur les commandes
        int j = 0; // indice sur les lignes de commande d'une commande
        
        
        // créer un http client
        HttpClient client = HttpClient.newHttpClient();
        // créer une requete http GET
        try {
            // construit l'url de la requete 
            HttpRequest request = HttpRequest.newBuilder()
                    .uri(new URI(API_url))
                    .build();
            // envoie la requete et attends la réponse
            HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());
            // verifie que le resultat est normale
            if(response.statusCode() == 200){
                json = response.body();
            } else{
                System.err.println("Erreur : Code statut " + response.statusCode());
            }
        } catch (Exception ex){
            System.err.println("Erreur : " + ex.getMessage());
            // ex.printStackTrace
        }
        // System.out.println(json);
        
        
        // parse le fichier et remplit la colelction d'objets métier       
        try{
            JSONArray commandes_json = new JSONArray(json);
            for (i = 0 ; i < commandes_json.length(); i++){
                // récupère la commande 
                JSONObject commande_json = commandes_json.getJSONObject(i);
                // récupère les lignes de commande de la commande
                lignes = new ArrayList<>(); // reinitialise la collection
                JSONArray lignes_json = commande_json.getJSONArray("Produits");
                // pour une commande on récupère le tableau "Produits"
                for (j = 0; j < lignes_json.length() ; j++){
                    JSONObject ligne_json = lignes_json.getJSONObject(j);
                    Ligne ligne = new Ligne(ligne_json.getInt("ID-produit"), ligne_json.getString("Plat"), ligne_json.getInt("Quantite"));
                    lignes.add(ligne);
                }
                
                // crée un objet métier à partir du json
                Commande commande = new Commande(
                                                 commande_json.getInt("ID_cmd"), 
                                                 commande_json.getInt("ID_user"), 
                                                 commande_json.getString("Date"),
                                                 commande_json.getString("Etat"),
                                                 commande_json.getInt("NB_plats"),
                                                 commande_json.getFloat("Montant"),
                                                 lignes
                                                );
                commandes.add(commande);
            } 
        } catch (Exception ex) {
            System.err.println("Erreur : " + ex.getMessage());
            ex.printStackTrace();
        }
   
        // construit le tableau de données à partir de la colection
        //Object[][] data = new Object[commandes.size()][6];
    
        //for (i = 0 ; i < commandes.size(); i++){
        //    data[i][0] = commandes.get(i).getIdCommande();
        //    data[i][1] = commandes.get(i).getIdUtilisateur();
        //    data[i][2] = commandes.get(i).getDate_commande();
        //    data[i][3] = commandes.get(i).getEtat();
        //    data[i][4] = commandes.get(i).getNbPlats();
        //    data[i][5] = commandes.get(i).getTotal_commande();             
        //} // for        
        //construit le tableau des entetes
        //String[] cols = {"ID_cmd", "ID_user", "Date", "Etat", "NB_plats", "Montant"};       
        // construit le modele
        // DefaultTableModel model_commande = new DefaultTableModel(data, cols);      
        //met à jour le modèle dans le JTable
        // table_commande.setModel(model_commande);
    
        MyTableModel model = new MyTableModel(commandes);
        table_commande.setModel(model);
    } 
    
    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        labelle_titre = new javax.swing.JLabel("Liste des commandes");
        table_commande = new javax.swing.JTable();
        jScrollPane = new javax.swing.JScrollPane();
        button_details = new javax.swing.JButton("Détails");
        button_quitter = new javax.swing.JButton("Quitter");


        button_details.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                button_detailsActionPerformed(evt);
            }
        });
        button_quitter.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                button_quitterActionPerformed(evt);
            }
        });
        
        jScrollPane.setViewportView(table_commande);

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);

        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addComponent(jScrollPane, javax.swing.GroupLayout.DEFAULT_SIZE, 400, Short.MAX_VALUE)
                .addGroup(layout.createSequentialGroup()
                    .addComponent(button_details)
                    .addComponent(button_quitter))
        );

        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                .addGroup(layout.createSequentialGroup()
                    .addComponent(jScrollPane, javax.swing.GroupLayout.DEFAULT_SIZE, 300, Short.MAX_VALUE)
                    .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                        .addComponent(button_details)
                        .addComponent(button_quitter)))
        );
        setSize(1000, 600);
        setLocationRelativeTo(null); // centre la fenêtre
    }// </editor-fold>//GEN-END:initComponents

    
    private void button_detailsActionPerformed(java.awt.event.ActionEvent evt){
        // récupère l'index de la ligne sélectionne dans le JTable
        int row = table_commande.getSelectedRow();
        // System.out.println("row ="+row);
        
        // récupère la commande séléctionnée et ouvre la fenetre JDialog des lignes de commande de la commande
        if (row >= 0 && row < table_commande.getRowCount()){
            // récupère la commande selectionnée 
            Commande commande = commandes.get(row);
            // System.out.println(region);
            
            // Créer la fenetre JDialog des lignes en passant la commande selectionnée
            Ligne ligne_liste = new Ligne(this, true, commande);
            
            // ajoute un listener quand la fenetre "ligne_liste" est fermée
            ligne_liste.addWindowListener(new WindowAdapter(){
                public void windowClosed(WindowEvent e){
                    System.out.println("jdioalog window closed"); // test
                    get_data(); // Rafraichit la jtable
                } // windowClosed()
                
            });
            
            // Affiche la fenetre des lignes
            ligne_liste.setVisible(true);
        } // if
    }
    
    private void button_quitterActionPerformed(java.awt.event.ActionEvent evt){
        // Ferme l'application 
        System.exit(0);
    }         
    
    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(Commande_liste.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex){
            java.util.logging.Logger.getLogger(Commande_liste.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);            
        } catch (IllegalAccessException ex){
            java.util.logging.Logger.getLogger(Commande_liste.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);            
        } catch (javax.swing.UnsupportedLookAndFeelException ex){
            java.util.logging.Logger.getLogger(Commande_liste.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);            
        }
        //</editor-fold>
        //</editor-fold> 
        
        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable()  {
            public void run() {
                new Commande_liste().setVisible(true);
            }
        });
    }
        
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton button_details;
    private javax.swing.JButton button_quitter;
    private javax.swing.JScrollPane jScrollPane;
    private javax.swing.JLabel labelle_titre;
    private javax.swing.JTable table_commande;
    // End of variables declaration//GEN-END:variables
}