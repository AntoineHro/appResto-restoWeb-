/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package restoswing;

import java.util.ArrayList;

/**
 *
 * @author antoine
 */
public class Commande {
    private int idCommande;
    private int idUtilisateur;
    private String date_commande;
    private String Etat;
    private String total_commande;
    private int nbPlats;
    private ArrayList<Ligne> lignes = new ArrayList<>();

    
    public Commande(int idCommande, int idUtilisateur, String date_commande, String Etat, int nbPlats, String total_commande, ArrayList<Ligne> lignes){
        this.idCommande = idCommande;
        this.idUtilisateur = idUtilisateur;
        this.date_commande = date_commande;
        this.Etat = Etat;
        this.nbPlats = nbPlats;
        this.total_commande = total_commande;
        this.lignes = lignes;
    }

    public void setIdCommande(int idCommande) {
        this.idCommande = idCommande;
    }

    public void setIdUtilisateur(int idUtilisateur) {
        this.idUtilisateur = idUtilisateur;
    }

    public void setDate_commande(String date_commande) {
        this.date_commande = date_commande;
    }

    public void setEtat(String Etat) {
        this.Etat = Etat;
    }

    public void setTotal_commande(String total_commande) {
        this.total_commande = total_commande;
    }

    public void setNbPlats(int nbPlats) {
        this.nbPlats = nbPlats;
    }

    public void setLignes(ArrayList<Ligne> lignes) {
        this.lignes = lignes;
    }

    public int getIdCommande() {
        return idCommande;
    }

    public int getIdUtilisateur() {
        return idUtilisateur;
    }

    public String getDate_commande() {
        return date_commande;
    }

    public String getEtat() {
        return Etat;
    }

    public String getTotal_commande() {
        return total_commande;
    }

    public int getNbPlats() {
        return nbPlats;
    }

    public ArrayList<Ligne> getLignes() {
        return lignes;
    }    
    
    public void afficher(){
        System.out.println("");
        System.out.println("ID" + idCommande);
        System.out.println("ID" + idUtilisateur);
        System.out.println("Date" + date_commande);
        System.out.println("Etat" + Etat);
        System.out.println("NB-plats" + nbPlats);
        System.out.println("Montant" + total_commande);
        System.out.println("Produits" );
        for (int i = 0 ; i < lignes.size() ; i ++){
            Ligne ligne = lignes.get(i);
            ligne.afficher();
        }
    }
}
